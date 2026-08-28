#!/bin/bash

# 1. Discover packages and cache config (now that env vars are loaded)
php artisan package:discover --ansi
php artisan config:cache
php artisan route:clear

# 2. Run migrations automatically
php artisan migrate --force

# 3. Start Apache in the foreground
apache2-foreground