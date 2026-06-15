<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\CustomNewsletterMail;
use App\Mail\JobNewsletterMail;
use App\Models\NewsletterSubscriber;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function index()
    {
        $subscribers  = NewsletterSubscriber::latest()->paginate(20, ['*'], 'sub_page');
        $users        = User::whereNotNull('email')->latest()->paginate(20, ['*'], 'user_page');
        $totalActive  = NewsletterSubscriber::where('is_active', true)->count();
        $totalAll     = NewsletterSubscriber::count();
        $totalUsers   = User::whereNotNull('email')->count();
        return view('admin.newsletter.index', compact('subscribers', 'users', 'totalActive', 'totalAll', 'totalUsers'));
    }

    public function destroy($id)
    {
        NewsletterSubscriber::findOrFail($id)->delete();
        return back()->with('success', 'Subscriber removed.');
    }

    public function toggleStatus($id)
    {
        $sub = NewsletterSubscriber::findOrFail($id);
        $sub->update(['is_active' => !$sub->is_active]);
        return back()->with('success', 'Status updated.');
    }

    /** Show compose form */
    public function compose()
    {
        $totalSubscribers = NewsletterSubscriber::where('is_active', true)->count();
        $totalUsers       = User::whereNotNull('email')->count();
        return view('admin.newsletter.compose', compact('totalSubscribers', 'totalUsers'));
    }

    /** Send custom newsletter to selected audience */
    public function sendCustom(Request $request)
    {
        $request->validate([
            'subject'    => 'required|string|max:255',
            'body'       => 'required|string',
            'send_to'    => 'required|array|min:1',
            'send_to.*'  => 'in:subscribers,users',
        ]);

        $emails = collect();

        if (in_array('subscribers', $request->send_to)) {
            NewsletterSubscriber::where('is_active', true)
                ->pluck('email')
                ->each(fn($e) => $emails->push($e));
        }

        if (in_array('users', $request->send_to)) {
            User::whereNotNull('email')
                ->pluck('email')
                ->each(fn($e) => $emails->push($e));
        }

        // Deduplicate
        $emails = $emails->unique()->values();

        if ($emails->isEmpty()) {
            return back()->with('error', 'No recipients found for the selected audience.');
        }

        $sent   = 0;
        $failed = 0;

        foreach ($emails as $email) {
            try {
                Mail::to($email)
                    ->send(new CustomNewsletterMail($request->subject, $request->body, $email));
                $sent++;
            } catch (\Exception $e) {
                \Log::error('Newsletter send failed to ' . $email . ': ' . $e->getMessage());
                $failed++;
            }
        }

        $msg = "Newsletter sent to {$sent} recipient(s).";
        if ($failed) $msg .= " {$failed} failed (check logs).";

        return redirect()->route('admin.newsletter.index')->with('success', $msg);
    }

    /** Called internally when a new job is created */
    public static function sendJobAlert(array $jobData)
    {
        // Collect all unique emails: newsletter subscribers + registered users
        $subscriberEmails = NewsletterSubscriber::where('is_active', true)->pluck('email');
        $userEmails       = User::whereNotNull('email')->pluck('email');

        $emails = $subscriberEmails->merge($userEmails)->unique()->values();

        foreach ($emails as $email) {
            try {
                Mail::to($email)->send(new JobNewsletterMail($jobData, $email));
            } catch (\Exception $e) {
                \Log::error('Job alert send failed to ' . $email . ': ' . $e->getMessage());
            }
        }
    }
}
