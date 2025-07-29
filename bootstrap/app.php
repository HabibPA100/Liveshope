<?php

use Illuminate\Foundation\Application;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('model:prune')->daily();
    })

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'buyer-auth' => App\Http\Middleware\EnsureBuyerIsAuthenticated::class,
            'seller-auth' => App\Http\Middleware\EnsureSellerIsAuthenticated::class,
            'admin-auth' => App\Http\Middleware\EnsureAdminIsAuthenticated::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
