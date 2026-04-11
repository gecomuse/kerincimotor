#!/bin/bash
cd ~/domains/kerincimotor.com/public_html

# Fix /public/.htaccess
cat > public/.htaccess << 'HTEOF'
<IfModule mod_rewrite.c>
    Options +FollowSymLinks
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} -f
    RewriteRule ^ - [L]
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
HTEOF

echo "public/.htaccess fixed"

# Fix root .htaccess
cat > .htaccess << 'HTEOF'
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ /public/$1 [L,QSA]
</IfModule>
HTEOF

echo "root .htaccess fixed"

# Clear caches
php artisan optimize:clear
php artisan filament:assets
php artisan config:cache

echo "DONE - test https://kerincimotor.com"
