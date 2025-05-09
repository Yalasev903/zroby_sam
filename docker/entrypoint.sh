#!/bin/bash

echo "🌐 PORT = $PORT"

if [ -z "$PORT" ]; then
    echo "❌ PORT is not set"
    exit 1
fi

# Генерация nginx-конфига
envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf
echo "✅ NGINX config generated"

# Очистка и миграция базы
echo "🔁 Rebuilding DB with migrate:fresh --seed..."
php artisan migrate:fresh --seed --force || exit 1
echo "✅ Fresh migration + seeding completed"

# Создание симлинка storage
echo "🔗 Linking storage..."
php artisan storage:link && echo "✅ Storage linked" || echo "⚠️ Storage link failed"

# Загрузка новин
echo "📰 Fetching news..."
php artisan news:fetch && echo "✅ News fetched" || echo "❌ News fetch failed"

# Оптимизация
echo "⚙️ Optimizing news..."
php artisan news:optimize && echo "✅ News optimized" || echo "❌ Optimization failed"

# Запуск supervisor
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
