#!/bin/bash
set -e
echo "Installing Composer dependencies..."
composer install --no-interaction

echo "⏳ Waiting for database to be ready..."

until php bin/console doctrine:query:sql "SELECT 1" > /dev/null 2>&1; do
  sleep 2
done

echo "Database is ready. Running migrations..."

php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

echo "Starting PHP built-in server..."
exec php -S 0.0.0.0:8000 -t public
