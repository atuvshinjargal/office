<?php

namespace TaskSharing\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \TaskSharing\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \TaskSharing\Http\Middleware\VerifyCsrfToken::class,
        \TaskSharing\Http\Middleware\InstallMiddleware::class
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \TaskSharing\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \TaskSharing\Http\Middleware\RedirectIfAuthenticated::class,
        'role' => \TaskSharing\Http\Middleware\RoleMiddleware::class,
        'level' => \TaskSharing\Http\Middleware\LevelMiddleware::class
    ];
}
