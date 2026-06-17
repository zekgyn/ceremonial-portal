<?php

use App\Http\Middleware\HandleAppearance;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->encryptCookies(except: ['appearance', 'sidebar_state']);

        $middleware->web(append: [
            HandleAppearance::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);

    $middleware->alias([
        'role' => RoleMiddleware::class,
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {


    $exceptions->render(function(AuthorizationException $e, Request $request) {

        // => $request->wantsJson()
        //     ? response()->json(['message' => 'Unauthorized to use this resource'], 403)
        //     : to_route('login')->with('message', 'Unauthorized Access')

        $user = $request->user();

        if ($user && $user->role === 'admin') {
            return redirect('/admin/dashboard');
        }

        if ($user && $user->role === 'vendor') {
            return redirect('/vendor/dashboard');
        }

        if ($user && $user->role === 'client') {
            return redirect('/client/dashboard');
        }

        });

    })->create();
