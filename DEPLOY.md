# Kerinci Motor — Deployment Guide

## Standard Deploy (Hostinger GIT)

### Step 1 — Make your changes in VS Code
Edit files, test locally if needed.

### Step 2 — Commit and push
```bash
git add .
git commit -m "your message here"
git push origin main
```

### Step 3 — Trigger deploy on Hostinger
1. Log in to [hPanel](https://hpanel.hostinger.com)
2. Go to **Websites → kerincimotor.com → Git**
3. Click **Deploy** (pulls latest `main` branch)
4. Wait for the "Deployment successful" confirmation

### Step 4 — Run post-deploy commands
Open this URL in your browser (or paste in terminal with curl):

```
https://kerincimotor.com/deploy-hook.php?token=km-deploy-2025
```

You should see plain-text output like:
```
=== Kerinci Motor Deploy Hook ===
[OK] php artisan storage:link
[OK] php artisan filament:assets
[OK] php artisan config:clear
[OK] php artisan cache:clear
[OK] php artisan view:clear
[OK] php artisan optimize:clear
✓ All commands succeeded. Site is ready.
```

### Step 5 — Verify
- [ ] Homepage loads with correct styling
- [ ] Car images are visible
- [ ] /admin panel loads with Filament CSS
- [ ] Check a car detail page

---

## What the deploy hook does

| Command | Purpose |
|---|---|
| `storage:link` | Recreates `public/storage → storage/app/public` symlink so uploaded images are served |
| `filament:assets` | Republishes Filament admin CSS/JS to `public/` |
| `config:clear` | Clears cached config (picks up any .env changes) |
| `cache:clear` | Clears application cache |
| `view:clear` | Clears compiled Blade templates |
| `optimize:clear` | Clears all remaining bootstrap caches |

---

## If something goes wrong

**White layout on public site** → Vite assets missing. Run `npm run build` locally, commit `public/build/`, push, redeploy.

**White layout on /admin** → Run the deploy hook URL again. If still broken, check `php artisan filament:assets` output.

**Images still broken after hook** → `storage:link` may have failed due to permissions. Contact Hostinger support to manually run `php artisan storage:link` or check file manager for the symlink.

**Deploy hook returns 403** → Token is wrong. Check the URL includes `?token=km-deploy-2025`.

**Deploy hook returns 500** → Check `storage/logs/laravel.log` via Hostinger File Manager.
