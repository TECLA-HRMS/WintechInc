<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        
        $prefilledEmail = $request->cookie('remembered_email');
        return view('site.login.index', ['prefilledEmail' => $prefilledEmail]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $email = $request->input('email');
        
        // Check if user exists in database
        $userExists = \App\Models\User::where('email', $email)->exists();
        
        if (!$userExists) {
            return redirect()->route('login')->with('signup_email', $email);
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            $response = redirect()->intended(route('home'));
            
            // If "Remember me" is checked, save the email in a long-lived cookie
            // so the login form is pre-filled next time even if they log out
            if ($remember) {
                $response->cookie(cookie()->forever('remembered_email', $email));
            } else {
                $response->withoutCookie('remembered_email');
            }
            
            return $response;
        }

        throw ValidationException::withMessages([
            'password' => 'Password is incorrect',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
