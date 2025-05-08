#!/bin/bash

echo "🌐 PORT = $PORT"

if [ -z "$PORT" ]; then
    echo "❌ PORT is not set"; exit 1
fi

# Генерация конфигурации Nginx
envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf

echo "✅ NGINX config generated:"
cat /etc/nginx/nginx.conf

# Запуск supervisor
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
