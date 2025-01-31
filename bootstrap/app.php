<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web/v1.php',
        api: __DIR__ . '/../routes/api/v1.php',
        commands: __DIR__ . '/../routes/console/v1.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withCommands(commands: [
        __DIR__ . '/../app/Modules/Synchronize/V1/Commands',
    ])
    ->withEvents(discover: [])
    ->withExceptions(function (Exceptions $exceptions) {
        /**
         * @var \Illuminate\Http\Request $request
         */
        $request = app(\Illuminate\Http\Request::class);
        if ($request->is('api/*')) {
        }
    })->create();
