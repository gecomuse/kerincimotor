<?php

/**
 * Laravel development server router.
 * Use: php -S 127.0.0.1:8888 server.php
 *
 * This allows PHP built-in server to:
 *  - Serve real static files (CSS, JS, images, storage) directly from public/
 *  - Route everything else through Laravel (public/index.php)
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Serve static files directly if they exist inside public/
if ($uri !== '/' && file_exists(__DIR__ . '/public' . $uri)) {
    return false;
}

$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/public/index.php';
require_once __DIR__ . '/public/index.php';
