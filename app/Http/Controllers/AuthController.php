<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;
use Carbon\Carbon;
use Twilio\Rest\Client;

class AuthController extends Controller
{
    // Show Login Page
    public function showLoginPage()
    {
        return view('admin.auth.login');
    }

    // Dashboard
    public function dashboard()
    {
        return view('admin.admin.index');
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Fetch admin record
        $admin = DB::table('admins')->where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors('Invalid credentials.');
        }

        // 🚫 Block inactive admins
        if ($admin->status == 0) {
            return back()->withErrors('Your account is inactive. Please contact the administrator.');
        }

        // ✅ Verify password
        if (!Hash::check($request->password, $admin->password)) {
            return back()->withErrors('Invalid credentials.');
        }

        // ✅ If active, proceed with login
        // (OTP logic commented out for testing)
        /*
        $otp = $this->generateOTP();
        Session::put('admin_otp', $otp);
        Session::put('admin_id', $admin->id);
        $this->sendOTP($admin->mobile_number, $otp);
        return redirect()->route('admin.otp');
        */

        // Direct login without OTP
        $request->session()->regenerate();
        Session::put('admin_id', $admin->id);
        Session::put('role', 'admin');
        Session::put('email', $admin->email);

        return redirect()->route('admin.dashboard')->with('success', 'Login successful.');
    }

    // OTP Verification View
    public function showOTPForm()
    {
        return view('admin.auth.otp');
    }

    // Verify OTP
    public function verifyOTP(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        if ($request->otp == Session::get('admin_otp')) {
            $admin_id = Session::get('admin_id');
            $admin = DB::table('admins')->where('id', $admin_id)->first();

            Session::forget(['admin_otp', 'admin_id']);
            Session::put('role', 'admin');
            Session::put('user_id', $admin->id);
            Session::put('email', $admin->email);

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors('Invalid OTP.');
    }

    private function generateOTP()
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    private function sendOTP($mobile_number, $otp)
    {
        try {
            $twilio_sid = env('TWILIO_SID');
            $twilio_token = env('TWILIO_AUTH_TOKEN');
            $twilio_phone_number = env('TWILIO_PHONE_NUMBER');

            $client = new Client($twilio_sid, $twilio_token);

            $message = $client->messages->create(
                $mobile_number,
                [
                    'from' => $twilio_phone_number,
                    'body' => "Your MMS Insurance OTP is: $otp. This code will expire in 10 minutes."
                ]
            );

            \Log::info("OTP sent successfully to {$mobile_number}. Message SID: {$message->sid}");
            return true;
        } catch (\Exception $e) {
            \Log::error("Failed to send OTP to {$mobile_number}. Error: " . $e->getMessage());
            return false;
        }
    }

    // Logout
    public function logout()
    {
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/admin/auth')->with('success', 'Logged out successfully.');
    }

    // Forgot Password
    public function showForgotPasswordPage()
    {
        return view('admin.auth.forgot-password');
    }

    public function handleForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $admin = DB::table('admins')->where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors('No active admin account was found for this email.');
        }

        if ((int) $admin->status !== 1) {
            return back()->withErrors('This admin account is inactive. Please contact the super admin.');
        }

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $admin->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        $resetUrl = route('admin.reset-password', ['token' => $token, 'email' => $admin->email]);

        Mail::send([], [], function ($message) use ($admin, $resetUrl) {
            $message->to($admin->email)
                ->subject('Reset your Wintech Inc admin password')
                ->html(
                    'Hello ' . e($admin->name ?? 'Admin') . ',<br><br>' .
                    'Click the link below to reset your admin password. This link will expire in 60 minutes.<br><br>' .
                    '<a href="' . e($resetUrl) . '">Reset Admin Password</a><br><br>' .
                    'If you did not request this, please ignore this email.'
                );
        });

        return back()->with('success', 'A password reset link has been sent to your email.');
    }

    // Reset Password
    public function showResetPasswordPage(Request $request, $token)
    {
        $email = $request->query('email');
        $reset = $email ? DB::table('password_resets')->where('email', $email)->first() : null;

        if (!$reset || !$this->isValidResetToken($reset, $token)) {
            return redirect()->route('admin.forgot-password')
                ->withErrors('This reset link is invalid or has expired. Please request a new link.');
        }

        return view('admin.auth.reset-password', compact('token', 'email'));
    }

    public function handleResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|min:6|confirmed',
        ]);

        $reset = DB::table('password_resets')->where('email', $request->email)->first();

        if (!$reset || !$this->isValidResetToken($reset, $request->token)) {
            return redirect()->route('admin.forgot-password')
                ->withErrors('This reset link is invalid or has expired. Please request a new link.');
        }

        $admin = DB::table('admins')->where('email', $request->email)->first();

        if (!$admin || (int) $admin->status !== 1) {
            return redirect()->route('admin.forgot-password')
                ->withErrors('Unable to reset this admin account.');
        }

        DB::table('admins')->where('email', $request->email)->update([
            'password' => Hash::make($request->password),
            'updated_at' => now(),
        ]);

        DB::table('password_resets')->where('email', $request->email)->delete();
        Session::flush();

        return redirect()->route('admin.login')->with('success', 'Password reset successfully. Please login with your new password.');
    }

    private function isValidResetToken($reset, string $token): bool
    {
        return Hash::check($token, $reset->token)
            && Carbon::parse($reset->created_at)->addMinutes(60)->isFuture();
    }
}
