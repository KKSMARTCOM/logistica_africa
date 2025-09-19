<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(
            ['auth-admin' => AdminMiddleware::class]
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            return response()->view('errors.404', [], 404);
        });

        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpException $e, $request) {
            if ($e->getStatusCode() === 403) {
                return response()->view('errors.403', [], 403);
            }

            if ($e->getStatusCode() === 401) {
                return response()->view('errors.401', [], 401);
            }
            dd($e);
            return response()->view('errors.default', ['message' => $e->getMessage()], $e->getStatusCode());
        });

        $exceptions->render(function (Throwable $e, $request) {
            dd($e);
            return response()->view('errors.500', ['error' => $e->getMessage()], 500);
        });
    })->create();
