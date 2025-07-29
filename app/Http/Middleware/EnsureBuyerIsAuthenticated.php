<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureBuyerIsAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('buyer')->check()) {
            return redirect()->route('login'); // buyer login route
        }

        return $next($request);
    }
}
