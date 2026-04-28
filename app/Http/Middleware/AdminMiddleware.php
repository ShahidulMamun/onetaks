<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        
        // check admin role + admin_type
        if ($user->role !== 'admin' || $user->admin_type != 1) {
            abort(403, 'Unauthorized Access');
        }
        return $next($request);
    }
}
