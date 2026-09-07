<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// 1. Static Asset Handler for PHP built-in server on Vercel
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH));
$publicFile = __DIR__ . '/../public' . $uri;

if ($uri !== '/' && !empty($uri) && is_file($publicFile)) {
    $mimeTypes = [
        'css'   => 'text/css',
        'js'    => 'application/javascript',
        'png'   => 'image/png',
        'jpg'   => 'image/jpeg',
        'jpeg'  => 'image/jpeg',
        'gif'   => 'image/gif',
        'svg'   => 'image/svg+xml',
        'ico'   => 'image/x-icon',
        'webp'  => 'image/webp',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
        'json'  => 'application/json',
    ];
    $ext = strtolower(pathinfo($publicFile, PATHINFO_EXTENSION));
    $mime = $mimeTypes[$ext] ?? (function_exists('mime_content_type') ? @mime_content_type($publicFile) : 'application/octet-stream');

    header("Content-Type: {$mime}");
    header("Content-Length: " . filesize($publicFile));
    header("Cache-Control: public, max-age=86400");
    readfile($publicFile);
    exit;
}

// 2. Prepare writable storage directory in /tmp for Vercel Serverless
$tmpStorage = '/tmp/storage';
$directories = [
    $tmpStorage,
    $tmpStorage . '/framework',
    $tmpStorage . '/framework/views',
    $tmpStorage . '/framework/cache',
    $tmpStorage . '/framework/cache/data',
    $tmpStorage . '/framework/sessions',
    $tmpStorage . '/logs',
    $tmpStorage . '/app',
    $tmpStorage . '/app/public',
    $tmpStorage . '/bootstrap',
    $tmpStorage . '/bootstrap/cache',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// 3. Copy pre-seeded SQLite database to /tmp
$sourceDb = __DIR__ . '/../database/database.sqlite';
$targetDb = '/tmp/database.sqlite';

if (file_exists($sourceDb) && (!file_exists($targetDb) || filesize($targetDb) === 0)) {
    @copy($sourceDb, $targetDb);
} elseif (!file_exists($targetDb)) {
    @touch($targetDb);
}

// 4. Force valid, non-empty environment variables
$defaults = [
    'APP_ENV' => 'production',
    'APP_DEBUG' => 'true',
    'APP_KEY' => 'base64:4dE1oZ2bUe58kMvF9Gv1P2m4x5y6z7A8b9c0d1e2f3g=',
    'APP_STORAGE' => $tmpStorage,
    'VIEW_COMPILED_PATH' => $tmpStorage . '/framework/views',
    'APP_PACKAGES_CACHE' => "{$tmpStorage}/bootstrap/cache/packages.php",
    'APP_SERVICES_CACHE' => "{$tmpStorage}/bootstrap/cache/services.php",
    'DB_CONNECTION' => 'sqlite',
    'DB_DATABASE' => $targetDb,
    'SESSION_DRIVER' => 'cookie',
    'CACHE_STORE' => 'array',
    'LOG_CHANNEL' => 'stderr',
    'QUEUE_CONNECTION' => 'sync',
    'AUTH_GUARD' => 'web',
    'APP_MAINTENANCE_DRIVER' => 'file',
    'APP_MAINTENANCE_STORE' => 'array',
    'MAIL_MAILER' => 'log',
    'BROADCAST_CONNECTION' => 'log',
    'FILESYSTEM_DISK' => 'local',
];

foreach ($defaults as $k => $def) {
    $val = getenv($k);
    if ($val === false || $val === '' || $val === null) {
        $val = $_ENV[$k] ?? ($_SERVER[$k] ?? null);
    }
    if ($val === false || $val === '' || $val === null) {
        $val = $def;
    }
    putenv("{$k}={$val}");
    $_ENV[$k] = $val;
    $_SERVER[$k] = $val;
}

// 5. Forward request to Laravel public/index.php
try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    error_log("ConnectED Serverless Exception: " . $e->getMessage() . "\n" . $e->getTraceAsString());
    http_response_code(500);
    echo "<h1>500 Server Error</h1>";
    echo "<p><strong>Message:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . " (Line " . $e->getLine() . ")</p>";
    echo "<pre style='background:#f1f5f9;padding:15px;border-radius:8px;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
