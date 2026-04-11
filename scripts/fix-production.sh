#!/usr/bin/env bash
# =============================================================================
# Kerinci Motor — Production Environment Fix Script
# Fixes ASSET_URL misconfiguration that causes Filament admin CSS to break.
# Safe to run multiple times.
# =============================================================================

set -e  # stop on first error

LARAVEL_ROOT=~/domains/kerincimotor.com/public_html

# ── STEP 1: Navigate to Laravel root ─────────────────────────────────────────
echo ""
echo "=== Kerinci Motor Production Fix ==="
echo "Working directory: $LARAVEL_ROOT"
cd "$LARAVEL_ROOT"

if [ ! -f ".env" ]; then
    echo "[ERROR] .env not found in $LARAVEL_ROOT"
    echo "        Are you on the right server? Check your SSH connection."
    exit 1
fi

# ── STEP 2: Show current values before editing ────────────────────────────────
echo ""
echo "=== BEFORE ==="
grep -E "APP_ENV|APP_DEBUG|APP_URL|ASSET_URL" .env

# ── STEP 3: Fix each value in .env ───────────────────────────────────────────
echo ""
echo "=== Patching .env ==="

sed -i 's|^APP_ENV=.*|APP_ENV=production|' .env
echo "  [OK] APP_ENV=production"

sed -i 's|^APP_DEBUG=.*|APP_DEBUG=false|' .env
echo "  [OK] APP_DEBUG=false"

sed -i 's|^APP_URL=.*|APP_URL=https://kerincimotor.com|' .env
echo "  [OK] APP_URL=https://kerincimotor.com"

sed -i 's|^ASSET_URL=.*|ASSET_URL=https://kerincimotor.com|' .env
echo "  [OK] ASSET_URL=https://kerincimotor.com"

# ── STEP 4: Show values after editing ────────────────────────────────────────
echo ""
echo "=== AFTER ==="
grep -E "APP_ENV|APP_DEBUG|APP_URL|ASSET_URL" .env

# ── STEP 5: Clear all caches ─────────────────────────────────────────────────
echo ""
echo "=== Clearing caches ==="
php artisan optimize:clear
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
echo "  [OK] All caches cleared"

# ── STEP 6: Republish Filament assets ────────────────────────────────────────
echo ""
echo "=== Publishing Filament assets ==="
php artisan filament:assets
echo "  [OK] Filament assets published"

# ── STEP 7: Rebuild config and route cache with correct values ───────────────
echo ""
echo "=== Rebuilding cache with production values ==="
php artisan config:cache
php artisan route:cache
echo "  [OK] Config and route cache rebuilt"

# ── STEP 8: Verify asset() generates the correct URL ─────────────────────────
echo ""
echo "=== Asset URL verification ==="
php artisan tinker --execute="
echo 'APP_URL    : ' . config('app.url') . PHP_EOL;
echo 'ASSET_URL  : ' . config('app.asset_url') . PHP_EOL;
echo 'Filament CSS URL: ' . asset('css/filament/filament/app.css') . PHP_EOL;
echo 'Filament JS  URL: ' . asset('js/filament/filament/app.js') . PHP_EOL;
echo 'CSS file exists : ' . (file_exists(public_path('css/filament/filament/app.css')) ? 'YES (' . filesize(public_path('css/filament/filament/app.css')) . ' bytes)' : 'NO — run: php artisan filament:assets') . PHP_EOL;
"

# ── STEP 9: Done ─────────────────────────────────────────────────────────────
echo ""
echo "=== DONE ==="
echo "Open https://kerincimotor.com/admin to verify styling is fixed."
echo ""
echo "If admin is still unstyled after this:"
echo "  1. Hard-refresh the browser (Ctrl+Shift+R)"
echo "  2. Check that Filament CSS URL above starts with https://kerincimotor.com"
echo "  3. Visit the deploy hook to re-run all commands:"
echo "     https://kerincimotor.com/deploy-hook.php?token=km-deploy-2025"
