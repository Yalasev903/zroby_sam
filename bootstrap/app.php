<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Доверие ко всем прокси (ngrok, cloudflare и т.д.)
        $middleware->trustProxies(
            at: '*',
            headers: Request::HEADER_X_FORWARDED_FOR |
                     Request::HEADER_X_FORWARDED_HOST |
                     Request::HEADER_X_FORWARDED_PORT |
                     Request::HEADER_X_FORWARDED_PROTO
        );

        // Исключение маршрутов из защиты CSRF
        $middleware->validateCsrfTokens(except: [
            'stripe/*', // Вебхуки Stripe
            '/register',
            'orders/*/payment/callback',
        ]);

        // Регистрация пользовательского промежуточного ПО
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Обработка исключений
    })
    ->withCommands([
        \App\Console\Commands\GenerateDailyNews::class,
        \App\Console\Commands\OptimizeNews::class,
    ])
    ->create();
