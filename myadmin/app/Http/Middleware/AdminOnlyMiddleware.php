<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminOnlyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('admin')->user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Access denied. Admin privileges required.');
        }

        return $next($request);
    }
}