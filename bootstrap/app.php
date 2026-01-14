<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\GuestAuthMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        /*
        |--------------------------------------------------------------------------
        | Middleware Alias
        |--------------------------------------------------------------------------
        | Digunakan untuk route middleware seperti:
        | ->middleware(['auth', 'role:admin'])
        | ->middleware('guest.auth')
        */
        $middleware->alias([
            'role'       => RoleMiddleware::class,
            'guest.auth' => GuestAuthMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Custom exception handling (optional)
    })
    ->create();
