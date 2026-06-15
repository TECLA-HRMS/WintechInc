<?php
// app/Http/Middleware/CheckProfileCompletion.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckProfileCompletion
{
    public function handle(Request $request, Closure $next, $minimum = 50)
    {
        if (Auth::check() && Auth::user()->profile_completion < $minimum) {
            return redirect()->route('profile.show')
                ->with('warning', 'Please complete your profile to access this feature.');
        }

        return $next($request);
    }
}