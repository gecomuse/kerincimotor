<?php
/**
 * Kerinci Motor — Post-Deploy Hook
 * Runs essential artisan commands after Hostinger GIT deploy.
 *
 * Trigger: https://kerincimotor.com/deploy-hook.php?token=km-deploy-2025
 *
 * SECURITY: Delete or rename this file if you add SSH access.
 */

$SECRET_TOKEN = 'km-deploy-2025';

// ── Auth ────────────────────────────────────────────────────────────────────
if (empty($_GET['token']) || $_GET['token'] !== $SECRET_TOKEN) {
    http_response_code(403);
    die('403 Forbidden');
}

header('Content-Type: text/plain; charset=utf-8');

// ── Pre-flight: read .env directly (before Laravel boots with cached config) ─
$laravelRoot = dirname(__DIR__);
$envFile     = $laravelRoot . '/.env';
$envValues   = [];
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with(trim($line), '#') || !str_contains($line, '=')) continue;
        [$key, $val]       = explode('=', $line, 2);
        $envValues[trim($key)] = trim($val, " \t\n\r\0\x0B\"'");
    }
}

echo "=== Kerinci Motor Deploy Hook ===\n";
echo "Time : " . date('Y-m-d H:i:s T') . "\n";
echo str_repeat('-', 40) . "\n\n";

// ── Pre-flight diagnostics ───────────────────────────────────────────────────
echo "PRE-FLIGHT CHECK\n";
$appUrl   = $envValues['APP_URL']   ?? '(not set)';
$assetUrl = $envValues['ASSET_URL'] ?? '(not set)';
$appEnv   = $envValues['APP_ENV']   ?? '(not set)';

echo "  APP_ENV   = {$appEnv}\n";
echo "  APP_URL   = {$appUrl}\n";
echo "  ASSET_URL = {$assetUrl}\n";

$urlProblems = [];
if (str_contains($appUrl, '127.0.0.1') || str_contains($appUrl, 'localhost')) {
    $urlProblems[] = "APP_URL points to localhost — must be https://kerincimotor.com";
}
if (!empty($assetUrl) && (str_contains($assetUrl, '127.0.0.1') || str_contains($assetUrl, 'localhost'))) {
    $urlProblems[] = "ASSET_URL points to localhost — must be https://kerincimotor.com or empty";
}
if ($appEnv !== 'production') {
    $urlProblems[] = "APP_ENV={$appEnv} — should be 'production' on live server";
}

if ($urlProblems) {
    echo "\n  [!] PROBLEMS DETECTED IN .env:\n";
    foreach ($urlProblems as $p) echo "      • {$p}\n";
    echo "\n  Fix these in your server .env before assets will load correctly.\n";
} else {
    echo "  [OK] URL config looks correct.\n";
}

echo "\n" . str_repeat('-', 40) . "\n\n";

// ── Bootstrap Laravel ────────────────────────────────────────────────────────
define('LARAVEL_START', microtime(true));
require $laravelRoot . '/vendor/autoload.php';
$app = require_once $laravelRoot . '/bootstrap/app.php';

// ── Helper: run an artisan command, capture output ───────────────────────────
function runArtisan(object $app, string $command): array
{
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $output = new Symfony\Component\Console\Output\BufferedOutput();
    $exit   = $kernel->call($command, [], $output);
    return [
        'command'  => "php artisan {$command}",
        'exit'     => $exit,
        'output'   => trim($output->fetch()),
        'ok'       => $exit === 0,
    ];
}

// ── Commands to run (full Phase 4 sequence) ──────────────────────────────────
$commands = [
    'storage:link',
    'filament:assets',
    'optimize:clear',
    'config:clear',     // clear first so config:cache reads fresh .env
    'cache:clear',
    'view:clear',
    'route:clear',
    'migrate --force',
    'config:cache',
    'route:cache',
];

$results = [];
$allOk   = true;

foreach ($commands as $cmd) {
    $result    = runArtisan($app, $cmd);
    $results[] = $result;
    if (! $result['ok']) $allOk = false;
}

echo "COMMANDS\n";
foreach ($results as $r) {
    $status = $r['ok'] ? '[OK]  ' : '[FAIL]';
    echo "  {$status} {$r['command']}\n";
    if ($r['output']) {
        foreach (explode("\n", $r['output']) as $line) {
            echo "        {$line}\n";
        }
    }
}

// ── Post-run verification ────────────────────────────────────────────────────
echo "\n" . str_repeat('-', 40) . "\n\n";
echo "VERIFICATION\n";

// 1. APP_URL and ASSET_URL from config (after config:cache with fresh .env)
$configAppUrl   = config('app.url');
$configAssetUrl = config('app.asset_url');
echo "  APP_URL   (config) : {$configAppUrl}\n";
echo "  ASSET_URL (config) : " . ($configAssetUrl ?: '(empty — falls back to APP_URL)') . "\n";

// 2. Resolved base for asset()
$resolvedBase = rtrim($configAssetUrl ?: $configAppUrl, '/');
echo "  asset() base       : {$resolvedBase}\n";

if (str_contains($resolvedBase, '127.0.0.1') || str_contains($resolvedBase, 'localhost')) {
    echo "\n  [!!!] CRITICAL: asset() is still generating localhost URLs.\n";
    echo "        Fix APP_URL and ASSET_URL in .env, then re-run this hook.\n";
} else {
    echo "  [OK] asset() base looks correct.\n";
}

// 3. Filament CSS and JS
$filamentCss = $laravelRoot . '/public/css/filament/filament/app.css';
$filamentJs  = $laravelRoot . '/public/js/filament/filament/app.js';

$cssExists = file_exists($filamentCss);
$jsExists  = file_exists($filamentJs);

echo "\n  Filament CSS : " . ($cssExists ? 'EXISTS (' . number_format(filesize($filamentCss)) . ' bytes)' : 'MISSING — run filament:assets') . "\n";
echo "  Filament JS  : " . ($jsExists  ? 'EXISTS (' . number_format(filesize($filamentJs))  . ' bytes)' : 'MISSING — run filament:assets') . "\n";
echo "  Filament CSS URL : {$resolvedBase}/css/filament/filament/app.css\n";

// 4. Storage symlink
$storagePath = $laravelRoot . '/public/storage';
if (is_link($storagePath)) {
    $target = readlink($storagePath);
    $targetExists = is_dir($storagePath);
    echo "\n  Storage symlink  : EXISTS → {$target}\n";
    echo "  Symlink target   : " . ($targetExists ? 'ACCESSIBLE' : 'BROKEN (target dir not found)') . "\n";
} elseif (is_dir($storagePath)) {
    echo "\n  Storage symlink  : Is a real directory (not a symlink) — storage:link may have failed\n";
} else {
    echo "\n  Storage symlink  : MISSING — storage:link failed\n";
}

$elapsed = round(microtime(true) - LARAVEL_START, 2);

echo "\n" . str_repeat('-', 40) . "\n";
echo "Took : {$elapsed}s\n";
echo $allOk
    ? "✓ All commands succeeded.\n"
    : "✗ One or more commands failed — check output above.\n";
