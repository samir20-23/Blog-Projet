<?php
namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        if (auth()->check() && auth()->user()->role === $role) {
            return $next($request);
        }

        return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
    }
}
