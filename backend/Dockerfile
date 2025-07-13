FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git zip unzip curl libpq-dev libzip-dev libxml2-dev libonig-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-interaction

COPY entrypoint.sh /entrypoint.sh
COPY entrypoint-scheduler.sh /entrypoint-scheduler.sh

RUN chmod +x /entrypoint.sh /entrypoint-scheduler.sh

ENTRYPOINT ["/entrypoint.sh"]