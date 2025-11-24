<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Allow the admin login routes without restriction
        if ($request->is('admin/login') || $request->is('admin/login/*')) {
            return $next($request);
        }

        // Check if admin session exists
        if (!session()->has('admin_id')) {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
