#!/bin/bash

echo "🌐 PORT = $PORT"

if [ -z "$PORT" ]; then
    echo "❌ PORT is not set"; exit 1
fi

# Генерация nginx-конфига
envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf
echo "✅ NGINX config generated"

# Миграции и сиды
echo "🔃 Running migrations and seeders..."
php artisan migrate --force
php artisan db:seed --force
echo "✅ Migrations and seeds completed"

# Ручной запуск загрузки новостей и оптимизации
echo "📰 Fetching news..."
php artisan news:fetch && echo "✅ News fetched" || echo "❌ News fetch failed"

echo "⚙️ Optimizing news..."
php artisan news:optimize && echo "✅ News optimized" || echo "❌ Optimization failed"

# Запуск Supervisor (в т.ч. cron)
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
