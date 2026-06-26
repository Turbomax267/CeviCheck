#!/usr/bin/env sh
set -e

if [ ! -f .env ]; then
  cp .env.example .env
fi

php artisan key:generate --force || true
php artisan jwt:secret --force || true
php artisan migrate --force || true
php artisan storage:link || true

if [ "${SEED_DEMO_DATA:-false}" = "true" ]; then
  php artisan db:seed --force || true
fi

php artisan serve --host=0.0.0.0 --port="${PORT:-10000}"
