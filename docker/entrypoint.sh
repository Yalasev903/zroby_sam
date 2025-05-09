#!/bin/bash

echo "🌐 PORT = $PORT"

if [ -z "$PORT" ]; then
    echo "❌ PORT is not set"
    exit 1
fi

# Генерация конфигурации nginx
envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf
echo "✅ NGINX config generated"

# Очистка и миграция базы + сиды
echo "🔁 Rebuilding DB with migrate:fresh --seed..."
php artisan migrate:fresh --seed --force || exit 1
echo "✅ Fresh migration + seeding completed"

# Симлинк storage
echo "🔗 Linking storage..."
php artisan storage:link && echo "✅ Storage linked" || echo "⚠️ Storage link failed"

# Запуск supervisor (nginx + php-fpm + cron)
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
