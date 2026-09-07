<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // === LOGIKA REDIRECT USER YANG SUDAH LOGIN ===
        // Jika user yang sudah login mencoba buka halaman /login, 
        // mereka akan dilempar kesini:
        
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