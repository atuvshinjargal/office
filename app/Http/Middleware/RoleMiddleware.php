<?php

namespace TaskSharing\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string $role
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (! $request->user()->roles->contains('slug', $role)) {
            return redirect('not-found');
        }

        return $next($request);
    }
}
