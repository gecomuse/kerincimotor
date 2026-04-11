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

// ── Bootstrap Laravel ────────────────────────────────────────────────────────
$laravelRoot = dirname(__DIR__);
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

// ── Commands to run ──────────────────────────────────────────────────────────
$commands = [
    'storage:link',
    'filament:assets',
    'config:clear',
    'cache:clear',
    'view:clear',
    'optimize:clear',
];

$results  = [];
$allOk    = true;

foreach ($commands as $cmd) {
    $result    = runArtisan($app, $cmd);
    $results[] = $result;
    if (! $result['ok']) {
        $allOk = false;
    }
}

$elapsed = round(microtime(true) - LARAVEL_START, 2);

// ── Output ───────────────────────────────────────────────────────────────────
header('Content-Type: text/plain; charset=utf-8');

echo "=== Kerinci Motor Deploy Hook ===\n";
echo "Time : " . date('Y-m-d H:i:s T') . "\n";
echo "Took : {$elapsed}s\n";
echo str_repeat('-', 40) . "\n\n";

foreach ($results as $r) {
    $status = $r['ok'] ? '[OK]' : '[FAIL]';
    echo "{$status} {$r['command']}\n";
    if ($r['output']) {
        foreach (explode("\n", $r['output']) as $line) {
            echo "      {$line}\n";
        }
    }
    echo "\n";
}

echo str_repeat('-', 40) . "\n";
echo $allOk
    ? "✓ All commands succeeded. Site is ready.\n"
    : "✗ One or more commands failed. Check output above.\n";
