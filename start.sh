#!/bin/bash

# 1. Wipe ALL caches (routes, config, views, events)
php artisan optimize:clear
php artisan package:discover --ansi

# 2. Run migrations
php artisan migrate --force

# 3. Start Apache
apache2-foreground