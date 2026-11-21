#!/usr/bin/env bash
set -e

cd /var/www/html

# Ensure SQLite database exists when using sqlite
if [ "${DB_CONNECTION:-sqlite}" = "sqlite" ]; then
    DB_PATH="${DB_DATABASE:-/var/www/html/database/database.sqlite}"
    mkdir -p "$(dirname "$DB_PATH")"
    touch "$DB_PATH"
fi

# Ensure storage symlink exists
if [ ! -e public/storage ]; then
    php artisan storage:link || true
fi

# Generate APP_KEY if not provided via environment
if [ -z "$APP_KEY" ] && [ -f .env ]; then
    php artisan key:generate --force || true
fi

# Run migrations and seed initial data idempotently
php artisan migrate --force
php artisan db:seed --force

# Cache configuration, routes, and views for fast production performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

PORT="${PORT:-8000}"
echo "Starting LE PROFESSIONNEL DES FLUIDES on 0.0.0.0:${PORT}"
exec php -S "0.0.0.0:${PORT}" -t public
