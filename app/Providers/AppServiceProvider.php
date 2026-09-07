<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Session\Store;
use SessionHandlerInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (
            (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
            (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
            env('APP_ENV') === 'production'
        ) {
            URL::forceScheme('https');
        }

        // Custom stateless session driver using a single fixed encrypted cookie
        Session::extend('serverless_cookie', function ($app) {
            return new class implements SessionHandlerInterface {
                protected string $cookieName = 'connected_session';

                    public function open($savePath, $sessionName): bool { return true; }
                    public function close(): bool { return true; }

                    public function read($sessionId): string|false
                    {
                        $cookie = request()->cookies->get($this->cookieName);
                        if (empty($cookie)) {
                            return '';
                        }
                        try {
                            $decrypted = Crypt::decryptString($cookie);
                            $data = json_decode($decrypted, true);
                            if (is_array($data) && isset($data['payload']) && ($data['expires'] ?? 0) >= time()) {
                                return (string) $data['payload'];
                            }
                        } catch (\Throwable $e) {
                            return '';
                        }
                        return '';
                    }

                    public function write($sessionId, $data): bool
                    {
                        try {
                            $payload = json_encode([
                                'payload' => $data,
                                'expires' => time() + (120 * 60),
                            ]);
                            $encrypted = Crypt::encryptString($payload);

                            cookie()->queue(cookie(
                                name: $this->cookieName,
                                value: $encrypted,
                                minutes: 120,
                                path: '/',
                                domain: null,
                                secure: true,
                                httpOnly: true,
                                raw: false,
                                sameSite: 'lax'
                            ));
                        } catch (\Throwable $e) {}
                        return true;
                    }

                    public function destroy($sessionId): bool
                    {
                        cookie()->queue(cookie()->forget($this->cookieName));
                        return true;
                    }

                    public function gc($lifetime): int { return 0; }
                };
        });
    }
}
