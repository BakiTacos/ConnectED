<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\ApplicationBuilder;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

$basePath = dirname(__DIR__);
$storagePath = getenv('APP_STORAGE') ?: ($_ENV['APP_STORAGE'] ?? null);

if ($storagePath) {
    $bootstrapCache = $storagePath . '/bootstrap/cache';
    if (!is_dir($bootstrapCache)) {
        @mkdir($bootstrapCache, 0755, true);
    }
    
    putenv("APP_PACKAGES_CACHE={$bootstrapCache}/packages.php");
    putenv("APP_SERVICES_CACHE={$bootstrapCache}/services.php");
    $_ENV['APP_PACKAGES_CACHE'] = "{$bootstrapCache}/packages.php";
    $_ENV['APP_SERVICES_CACHE'] = "{$bootstrapCache}/services.php";
    $_SERVER['APP_PACKAGES_CACHE'] = "{$bootstrapCache}/packages.php";
    $_SERVER['APP_SERVICES_CACHE'] = "{$bootstrapCache}/services.php";
}

$app = new Application($basePath);

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
        $middleware->trustProxies(at: '*');
        $middleware->validateCsrfTokens(except: ['*']);
        
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