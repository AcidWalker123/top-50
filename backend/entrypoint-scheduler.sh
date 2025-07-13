#!/bin/bash
set -e

echo "⏳ Waiting for database to be ready..."

until php bin/console doctrine:query:sql "SELECT 1" > /dev/null 2>&1; do
  sleep 2
done

echo "Database is ready. Starting scheduled tasks..."
exec "$@"
