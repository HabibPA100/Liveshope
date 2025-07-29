<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                switch ($guard) {
                    case 'buyer':
                        return redirect()->route('buyer.dashboard');
                    case 'seller':
                        return redirect()->route('seller.dashboard');
                    default:
                        return redirect('/admin/dashboard'); // admin ড্যাশবোর্ড
                }
            }
        }

        return $next($request);
    }
}
