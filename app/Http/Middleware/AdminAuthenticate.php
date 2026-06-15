<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdminAuthenticate
{
    private array $publicRoutes = [
        'admin.login',
        'admin.login.submit',
        'admin.forgot-password',
        'admin.forgot-password.submit',
        'admin.reset-password',
        'admin.reset-password.submit',
        'admin.admin.otp',
        'admin.admin.verify-otp',
    ];

    public function handle(Request $request, Closure $next)
    {
        if ($request->routeIs(...$this->publicRoutes)) {
            return $next($request);
        }

        $adminId = Session::get('admin_id');

        if (!$adminId) {
            return $this->redirectToLogin($request, 'Please login to access the admin panel.');
        }

        $admin = DB::table('admins')->where('id', $adminId)->first();

        if (!$admin || (int) $admin->status !== 1) {
            Session::flush();

            return $this->redirectToLogin($request, 'Your session has expired. Please login again.');
        }

        return $next($request);
    }

    private function redirectToLogin(Request $request, string $message)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $message], 401);
        }

        return redirect()->route('admin.login')->withErrors($message);
    }
}
