#!/bin/bash

echo "🌐 PORT = $PORT"

if [ -z "$PORT" ]; then
    echo "❌ PORT is not set"; exit 1
fi

# Генерация конфигурации Nginx
envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf
echo "✅ NGINX config generated"

# Запуск миграций и сидеров
echo "🔃 Running migrations and seeders..."
php artisan migrate --force
php artisan db:seed --force
echo "✅ Migrations and seeds completed"

# Запуск supervisor (nginx + php-fpm + cron)
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
