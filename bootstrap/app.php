<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\ApplicationBuilder;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

$basePath = dirname(__DIR__);
$app = new Application($basePath);

// Set storage path to /tmp/storage early if running on Vercel / serverless
$storagePath = getenv('APP_STORAGE') ?: ($_ENV['APP_STORAGE'] ?? null);
if ($storagePath) {
    $app->useStoragePath($storagePath);
}

return (new ApplicationBuilder($app))
    ->withKernels()
    ->withEvents()
    ->withCommands()
    ->withProviders()
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // === LOGIKA REDIRECT USER YANG SUDAH LOGIN ===
        $middleware->redirectUsersTo(function (Request $request) {
            $user = Auth::user();

            // 1. Jika Admin, lempar ke Dashboard Admin
            if ($user && $user->role === 'admin') {
                return route('admin.dashboard');
            }

            // 2. Jika User Biasa, lempar ke Home
            return route('home');
        });
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();