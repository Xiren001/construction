<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if (Auth::check() && Auth::user()->usertype === 'user') {
            // Redirect users with `usertype=user` to another page
            return redirect('/')->with('error', 'Access denied.');
        }

        return $next($request);
    }
}
