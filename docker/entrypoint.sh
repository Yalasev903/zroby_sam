#!/bin/bash

# Генерация nginx.conf из шаблона с переменной $PORT
envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf

# Запуск Supervisor
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
