#!/bin/bash

# Run migrations automatically
php artisan migrate --force

# Start Apache in the foreground
apache2-foreground