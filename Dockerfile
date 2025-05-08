FROM php:8.2-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    nginx \
    cron \
    supervisor \
    git \
    curl \
    unzip \
    gettext \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    zip \
    && docker-php-ext-install pdo_mysql zip gd bcmath

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Копирование проекта
WORKDIR /var/www/robotapro
COPY . .

# Установка зависимостей Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && chown -R www-data:www-data /var/www/robotapro/storage /var/www/robotapro/bootstrap/cache

# Копирование конфигураций
COPY docker/nginx.conf.template /etc/nginx/nginx.conf.template
COPY docker/supervisord.conf /etc/supervisor/supervisord.conf
COPY docker/crontab /etc/cron.d/laravel-cron
COPY docker/entrypoint.sh /etc/entrypoint.sh

RUN chmod 0644 /etc/cron.d/laravel-cron && crontab /etc/cron.d/laravel-cron
RUN chmod +x /etc/entrypoint.sh

ENV PORT=8080

EXPOSE 8080

ENTRYPOINT ["/etc/entrypoint.sh"]
