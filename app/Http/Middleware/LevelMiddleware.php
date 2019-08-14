<?php

namespace TaskSharing\Http\Middleware;

use Closure;

class LevelMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param int $level
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $level)
    {
        if ($request->user()->level() > $level) {
            return $next($request);
        }

        return redirect('not-found');
    }
}
