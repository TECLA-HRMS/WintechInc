<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return redirect()->route('login')->with('open_forgot', true);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No account found with that email address.']);
        }

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        $resetUrl = route('password.reset', ['token' => $token, 'email' => $user->email]);

        try {
            Mail::send([], [], function ($message) use ($user, $resetUrl) {
                $message->to($user->email)
                    ->subject('Reset your Wintech Inc password')
                    ->html(
                        'Hello ' . e($user->first_name ?? 'User') . ',<br><br>' .
                        'Click the link below to reset your password. This link will expire in 60 minutes.<br><br>' .
                        '<a href="' . e($resetUrl) . '">Reset Password</a><br><br>' .
                        'If you did not request this, please ignore this email.'
                    );
            });
        } catch (\Exception $e) {
            Log::error('Password reset email failed for ' . $user->email . ': ' . $e->getMessage());
            return back()->withErrors(['email' => 'Failed to send email. Please try again later.']);
        }

        return redirect()->route('login')->with('status', 'A password reset link has been sent to your email address.');
    }

    public function showResetPasswordPage(Request $request, $token)
    {
        $email = $request->query('email');
        $reset = $email ? DB::table('password_resets')->where('email', $email)->first() : null;

        if (!$reset || !$this->isValidResetToken($reset, $token)) {
            return redirect()->route('login')
                ->with('open_forgot', true)
                ->withErrors(['email' => 'This reset link is invalid or has expired. Please request a new link.']);
        }

        return view('site.auth.reset-password', compact('token', 'email'));
    }

    public function handleResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|min:8|confirmed',
        ]);

        $reset = DB::table('password_resets')->where('email', $request->email)->first();

        if (!$reset || !$this->isValidResetToken($reset, $request->token)) {
            return redirect()->route('login')
                ->with('open_forgot', true)
                ->withErrors(['email' => 'This reset link is invalid or has expired. Please request a new link.']);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->route('login')
                ->with('open_forgot', true)
                ->withErrors(['email' => 'Unable to reset this account.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('status', 'Password reset successfully. Please login with your new password.');
    }

    private function isValidResetToken($reset, string $token): bool
    {
        return Hash::check($token, $reset->token)
            && Carbon::parse($reset->created_at)->addMinutes(60)->isFuture();
    }
}
