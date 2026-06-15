<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdminSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminSettingsController extends Controller
{
    public function index()
    {
        $this->authorizeSuperAdmin();

        $s = AdminSetting::allDecrypted();
        return view('admin.settings.index', compact('s'));
    }

    // ── General Settings ──────────────────────────────────────────────────────
    public function saveGeneral(Request $request)
    {
        $this->authorizeSuperAdmin();

        $request->validate([
            'site_name'    => 'required|string|max:255',
            'site_email'   => 'required|email',
            'site_phone'   => 'nullable|string|max:30',
            'site_address' => 'nullable|string|max:500',
            'site_logo'    => 'nullable|image|mimes:jpeg,png,gif,svg,webp|max:2048',
            'site_favicon' => 'nullable|image|mimes:jpeg,png,gif,ico|max:512',
        ]);

        $textFields = [
            'site_name', 'site_email', 'site_phone', 'site_address',
            'fb_link', 'instagram_link', 'twitter_link', 'linkedin_link', 'youtube_link',
            'google_map_url',
        ];

        foreach ($textFields as $field) {
            AdminSetting::set($field, $request->input($field, ''));
        }

        if ($request->hasFile('site_logo')) {
            $request->file('site_logo')->move(public_path('frontend/images/logos'), 'logo-admin.png');
            AdminSetting::set('site_logo', 'frontend/images/logos/logo-admin.png');
        }

        if ($request->hasFile('site_favicon')) {
            $request->file('site_favicon')->move(public_path('frontend/images/logos'), 'favicon-admin.png');
            AdminSetting::set('site_favicon', 'frontend/images/logos/favicon-admin.png');
        }

        return back()->with('success_general', 'General settings saved successfully!');
    }

    // ── Email / SMTP Settings → stored in DB (password encrypted) ────────────
    public function saveEmail(Request $request)
    {
        $this->authorizeSuperAdmin();

        $request->validate([
            'mail_host'         => 'required|string|max:255',
            'mail_port'         => 'required|integer|min:1|max:65535',
            'mail_username'     => 'required|email',
            'mail_password'     => 'required|string|min:1',
            'mail_encryption'   => 'required|in:tls,ssl,none',
            'mail_from_address' => 'required|email',
            'mail_from_name'    => 'required|string|max:255',
        ]);

        // Plain-text fields
        $plain = [
            'mail_host', 'mail_port', 'mail_username',
            'mail_encryption', 'mail_from_address', 'mail_from_name',
        ];
        foreach ($plain as $field) {
            AdminSetting::set($field, $request->input($field));
        }

        // Password is encrypted automatically by AdminSetting::set()
        AdminSetting::set('mail_password', $request->mail_password);

        // Apply to running config immediately (no restart needed)
        config([
            'mail.default'                    => 'smtp',
            'mail.mailers.smtp.host'          => $request->mail_host,
            'mail.mailers.smtp.port'          => $request->mail_port,
            'mail.mailers.smtp.encryption'    => $request->mail_encryption === 'none' ? null : $request->mail_encryption,
            'mail.mailers.smtp.username'      => $request->mail_username,
            'mail.mailers.smtp.password'      => $request->mail_password,
            'mail.from.address'               => $request->mail_from_address,
            'mail.from.name'                  => $request->mail_from_name,
        ]);

        return back()->with('success_email', 'Email configuration saved securely!');
    }

    // ── Send Test Email ───────────────────────────────────────────────────────
    public function testMail()
    {
        $this->authorizeSuperAdmin();

        try {
            $to = AdminSetting::get('mail_from_address', config('mail.from.address'));

            Mail::raw(
                'This is a test email from your Syn Star admin panel. SMTP is configured correctly!',
                fn($msg) => $msg->to($to)->subject('✅ Test Email — SMTP Working')
            );

            return response()->json(['success' => true, 'message' => 'Test email sent to ' . $to]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    private function authorizeSuperAdmin(): void
    {
        $admin = DB::table('admins')->where('id', session('admin_id'))->first();

        abort_unless($admin && $admin->role === 'super_admin', 403);
    }
}
