#!/bin/bash

echo "🌐 PORT = $PORT"

if [ -z "$PORT" ]; then
    echo "❌ PORT is not set"; exit 1
fi

# Генерация nginx-конфига
envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf
echo "✅ NGINX config generated"

# Полный сброс базы и сиды
echo "🔁 Rebuilding DB with migrate:fresh --seed..."
php artisan migrate:fresh --seed --force
echo "✅ Fresh migration + seeding completed"

# Загрузка новостей
echo "📰 Fetching news..."
php artisan news:fetch && echo "✅ News fetched" || echo "❌ News fetch failed"

# Оптимизация новостей
echo "⚙️ Optimizing news..."
php artisan news:optimize && echo "✅ News optimized" || echo "❌ Optimization failed"

# Запуск supervisor (nginx + php-fpm + cron)
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
