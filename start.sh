#!/bin/bash
set -e

cd GenzBanking

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Copy .env file if it doesn't exist
if [ ! -f .env ]; then
    cp .env.example .env
fi

# Generate app key if needed
php artisan key:generate || true

# Start the Laravel app
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
