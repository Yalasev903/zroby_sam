FROM php:8.2-fpm

# Установка зависимостей
RUN apt-get update && apt-get install -y \
    nginx \
    cron \
    supervisor \
    git \
    curl \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    zip \
    && docker-php-ext-install pdo_mysql zip gd

# Установка Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Копирование проекта
WORKDIR /var/www/robotapro
COPY . .

# Установка зависимостей Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader \
    && chown -R www-data:www-data /var/www/robotapro/storage /var/www/robotapro/bootstrap/cache

# Копируем конфиги
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/supervisord.conf
COPY docker/crontab /etc/cron.d/laravel-cron

RUN chmod 0644 /etc/cron.d/laravel-cron && crontab /etc/cron.d/laravel-cron

EXPOSE 8080

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
