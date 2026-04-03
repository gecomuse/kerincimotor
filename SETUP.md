# Kerinci Motor — Setup & Deployment Guide

## Tech Stack
- **Backend**: Laravel 11
- **Database**: MySQL 8
- **CMS**: Filament v3
- **CSS**: Tailwind CSS v3
- **JS**: Alpine.js + Livewire v3
- **Media**: Spatie Media Library
- **SEO**: Artesaos SEOTools + Spatie Sitemap

---

## 🚀 Quick Start (Local Development)

### 1. Install PHP dependencies
```bash
composer install
```

### 2. Install Node dependencies
```bash
npm install
```

### 3. Set up environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure `.env`
```env
APP_URL=http://localhost
DB_DATABASE=kerincimotor
DB_USERNAME=root
DB_PASSWORD=your_password

# Your secret admin registration token (keep this private!)
ADMIN_REGISTER_TOKEN=your-secret-token-here

# Google Analytics 4 (optional)
GA4_MEASUREMENT_ID=G-XXXXXXXXXX
```

### 5. Run migrations & seed
```bash
php artisan migrate --seed
```

### 6. Create storage symlink
```bash
php artisan storage:link
```

### 7. Build assets
```bash
npm run dev        # development
npm run build      # production
```

### 8. Start server
```bash
php artisan serve
```

---

## 🔐 Create Your First Admin Account

After running migrations, visit this **secret URL** in your browser:

```
http://localhost/admin-register/YOUR_TOKEN_HERE
```

Replace `YOUR_TOKEN_HERE` with the value you set in `.env` as `ADMIN_REGISTER_TOKEN`.

> **Important:** This URL is only accessible if you know the exact token.
> Keep it confidential — it is not linked from anywhere on the website.

After creating your account, log in at: `http://localhost/admin`

---

## 🌐 Deploying to Hostinger

### Step 1 — Hostinger hPanel Setup
1. Enable **PHP 8.2+** in hPanel
2. Create a **MySQL database** — note the DB name, username, and password
3. Activate **SSL** (free via Let's Encrypt in hPanel)

### Step 2 — Upload Files
Option A — **Git Deploy** (recommended):
1. Push your project to GitHub
2. In hPanel → Git → Connect your repo → set deploy path to `public_html`

Option B — **FTP/File Manager**:
1. Upload all files EXCEPT `node_modules/` and `.git/`
2. Make sure `public/` contents go to `public_html/`

### Step 3 — Configure `.env` on server
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://kerincimotor.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password

ADMIN_REGISTER_TOKEN=your-secret-token-change-this
```

### Step 4 — Run server commands (via SSH or hPanel terminal)
```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --seed --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

### Step 5 — Set folder permissions
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

---

## 📋 CMS Features Summary

| Feature | Description |
|---|---|
| **Vehicle CRUD** | Add/edit/delete cars, upload up to 8 photos each |
| **Testimonials** | Manage customer reviews with star ratings |
| **Settings** | Edit WhatsApp number, hero text, address, hours, maps |
| **Sell Inquiries** | View & manage leads from the Sell Your Car form |

### CMS Navigation
- **Vehicles** — `/admin/cars` — manage inventory
- **Testimonials** — `/admin/testimonials` — manage reviews
- **Settings** — `/admin/settings` — global site settings
- **Sell Inquiries** — `/admin/sell-inquiries` — buyer leads with WA quick-contact

---

## 🔗 WhatsApp Number

The WhatsApp number is **never hardcoded**. It is always read from the `settings` table (`key: wa_number`).

To change the WhatsApp number: CMS → Settings → Edit `wa_number`.

Default: `6287776700009`

---

## 🔍 SEO

- Meta title & description: pulled from Settings table
- Per-unit OG tags: auto-generated on PDP
- Sitemap: `https://kerincimotor.com/sitemap.xml`
- robots.txt: `/admin` is disallowed

---

## 📊 Google Analytics 4

Set `GA4_MEASUREMENT_ID=G-XXXXXXXXXX` in `.env`.

Tracked events:
- `wa_click_hero`, `wa_click_navbar`, `wa_click_catalog`, `wa_click_pdp`, `wa_click_floating`, `wa_click_footer`
- `filter_applied`, `filter_reset`
- `pdp_view`
- `sell_form_submit`

---

## 🛡️ Security Notes

- Admin registration URL: `/admin-register/{YOUR_TOKEN}` — change `ADMIN_REGISTER_TOKEN` to something long and random
- Rate limiting: Sell Your Car form is limited to **5 submissions per IP per hour**
- CSRF protection is enabled on all POST requests
- File uploads: only JPG/PNG/WebP, max 5MB
- `/admin` is disallowed in `robots.txt`
