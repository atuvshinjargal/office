<?php

namespace TaskSharing\Http\Middleware;

use Closure;

class InstallMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! \File::exists(config_path('database.php')) && $request->segment(1) !== 'install') {
            return redirect('install');
        }

        return $next($request);
    }
}