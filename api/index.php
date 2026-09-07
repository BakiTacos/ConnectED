<?php

// 1. Static Asset Handler for PHP built-in server on Vercel
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH));
$publicFile = __DIR__ . '/../public' . $uri;

if ($uri !== '/' && is_file($publicFile)) {
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
    $mime = $mimeTypes[$ext] ?? mime_content_type($publicFile) ?: 'application/octet-stream';

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

// 4. Set environment variables for serverless runtime
$envVars = [
    'APP_KEY' => getenv('APP_KEY') ?: ($_ENV['APP_KEY'] ?? 'base64:4dE1oZ2bUe58kMvF9Gv1P2m4x5y6z7A8b9c0d1e2f3g='),
    'APP_STORAGE' => $tmpStorage,
    'VIEW_COMPILED_PATH' => $tmpStorage . '/framework/views',
    'DB_CONNECTION' => 'sqlite',
    'DB_DATABASE' => $targetDb,
    'SESSION_DRIVER' => 'cookie',
    'CACHE_STORE' => 'array',
    'LOG_CHANNEL' => 'stderr',
    'APP_SERVICES_CACHE' => $tmpStorage . '/bootstrap/cache/services.php',
    'APP_PACKAGES_CACHE' => $tmpStorage . '/bootstrap/cache/packages.php',
    'APP_CONFIG_CACHE' => $tmpStorage . '/bootstrap/cache/config.php',
    'APP_ROUTES_CACHE' => $tmpStorage . '/bootstrap/cache/routes.php',
    'APP_EVENTS_CACHE' => $tmpStorage . '/bootstrap/cache/events.php',
];

foreach ($envVars as $key => $val) {
    putenv("{$key}={$val}");
    $_ENV[$key] = $val;
    $_SERVER[$key] = $val;
}

// 5. Forward request to Laravel public/index.php
try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    error_log("ConnectED Serverless Error: " . $e->getMessage() . "\n" . $e->getTraceAsString());
    http_response_code(500);
    echo "<h1>500 Server Error</h1>";
    echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}
