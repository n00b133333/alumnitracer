<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    // public function handle($request, Closure $next)
    // {
    //     if (!Auth::guard('admin')->check()) {
    //         return redirect('/admin/login'); // Redirect to admin login
    //     }

    //     return $next($request);
    // }

    public function handle($request, Closure $next)
    {
        // Check if the authenticated user is an Admin
        if (!$request->user('admin')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
