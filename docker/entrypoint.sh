#!/bin/bash

echo "🌐 PORT = $PORT"

if [ -z "$PORT" ]; then
    echo "❌ PORT is not set"
    exit 1
fi

# Генерация nginx-конфига
envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf
echo "✅ NGINX config generated"

# Миграции и сиды
echo "🔁 Rebuilding DB with migrate:fresh --seed..."
php artisan migrate:fresh --seed --force || exit 1
echo "✅ Fresh migration + seeding completed"

# Симлинк storage
echo "🔗 Linking storage..."
php artisan storage:link && echo "✅ Storage linked" || echo "⚠️ Storage link failed"

# Первый запуск команд
echo "📰 Fetching news..."
php artisan news:fetch && echo "✅ News fetched" || echo "❌ News fetch failed"

echo "⚙️ Optimizing news..."
php artisan news:optimize && echo "✅ News optimized" || echo "❌ Optimization failed"

# Supervisor запуск
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
