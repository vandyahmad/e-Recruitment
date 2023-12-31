<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleAdmin
{
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and has a role_id of 1
        if (Auth::check() && Auth::user()->role_id == 1) {
            return $next($request);
        }

        // Redirect or return an error response if the user doesn't have the required role
        return redirect('/')->with('error', 'Unauthorized');
    }
}
