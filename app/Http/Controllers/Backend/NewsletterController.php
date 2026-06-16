<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\CustomNewsletterMail;
use App\Mail\JobNewsletterMail;
use App\Models\NewsletterSubscriber;
use App\Models\User;
use App\Models\JobFunction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function index()
    {
        $users = User::whereNotNull('email')->latest()->paginate(10, ['*'], 'page');
        $totalUsers = User::whereNotNull('email')->count();
        return view('admin.newsletter.index', compact('users', 'totalUsers'));
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
        $totalUsers = User::whereNotNull('email')->count();
        $jobFunctions = JobFunction::where('status', 'active')->get();
        return view('admin.newsletter.compose', compact('totalUsers', 'jobFunctions'));
    }

    /** Send custom newsletter to selected audience */
    public function sendCustom(Request $request)
    {
        $request->validate([
            'subject'         => 'required|string|max:255',
            'body'            => 'required|string',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'job_function_id' => 'nullable|exists:job_functions,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('newsletters'), $filename);
            $imagePath = 'newsletters/' . $filename;
        }

        $query = User::whereNotNull('email');
        if ($request->job_function_id) {
            $query->where('job_function_id', $request->job_function_id);
        }

        $emails = $query->pluck('email')
            ->unique()
            ->values();

        if ($emails->isEmpty()) {
            return back()->with('error', 'No recipients found for the selected audience.');
        }

        $sent   = 0;
        $failed = 0;

        foreach ($emails as $email) {
            try {
                Mail::to($email)
                    ->send(new CustomNewsletterMail($request->subject, $request->body, $email, $imagePath));
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
