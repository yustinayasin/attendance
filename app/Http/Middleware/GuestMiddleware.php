<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // If user is authenticated, redirect them to the home or dashboard page
        if (Auth::check()) {
            return redirect('/dashboard'); // Redirect to dashboard or another page
        }

        return $next($request); // Allow access if guest
    }
}
