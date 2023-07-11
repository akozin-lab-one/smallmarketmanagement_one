<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class adminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (!empty(Auth::user())) {
            // dd(true);
            if (url()->current() == route('Auth#login') || url()->current() == route('Auth#register')) {
                return back();
            }

            if (Auth::user()->role == 'superuser') {
                return back();
            }
            return $next($request);

        }
        return $next($request);
    }
}
