<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (auth()->check()) {

            $user = auth()->user();

            if ($user->role === 'admin' && $user->admin_type == 1) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');
        }
        return $next($request);
    }
}
