#!/bin/bash

# Сбросить кэш Laravel
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "🌐 PORT = $PORT"

if [ -z "$PORT" ]; then
    echo "❌ PORT is not set"
    exit 1
fi

# Генерация nginx-конфига
envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf
echo "✅ NGINX config generated"

# Только migrate --force, НИКАКОГО fresh!
echo "🔁 Running migrations (no fresh)..."
php artisan migrate --force || exit 1
echo "✅ Migrations completed"

# Симлинк storage
echo "🔗 Linking storage..."
php artisan storage:link && echo "✅ Storage linked" || echo "⚠️ Storage link failed"

# Supervisor запуск
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
