#!/bin/bash

echo "🌐 PORT = $PORT"

# Генерация nginx.conf
if [ -z "$PORT" ]; then
    echo "❌ PORT is not set"; exit 1
fi

envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf

echo "✅ NGINX config generated at /etc/nginx/nginx.conf:"
cat /etc/nginx/nginx.conf

# Запуск supervisor
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
