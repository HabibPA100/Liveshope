<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureSellerIsAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('seller')->check()) {
            return redirect()->route('login'); // seller login route
        }

        return $next($request);
    }
}
