#!/bin/bash

# Генерация nginx.conf из шаблона с подстановкой $PORT
envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf

# Запуск supervisor, который управляет nginx, php-fpm и cron
exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
