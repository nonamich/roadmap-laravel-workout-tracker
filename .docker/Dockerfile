FROM php:8.3-fpm-alpine AS php-base
RUN apk add --no-cache \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    sqlite-dev \
    libxml2-dev
RUN docker-php-ext-install pdo_mysql
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

FROM php-base AS vendor
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer install --no-scripts  --no-dev --no-interaction --prefer-dist --optimize-autoloader

FROM php-base AS laravel-base
WORKDIR /var/www/html
COPY . .
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html/database && \
    chmod -R 755 /var/www/html/storage && \
    chmod -R 755 /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage && \
    chmod -R 775 /var/www/html/bootstrap/cache
COPY --from=vendor /var/www/html/vendor/ vendor/
RUN composer dump-autoload

FROM laravel-base AS laravel-queue
CMD [ "php", "artisan", "queue:listen" ]

FROM laravel-base AS laravel-schedule
CMD [ "php", "artisan", "schedule:work" ]

FROM laravel-base AS laravel-fpm
EXPOSE 9000
CMD [ "-F" ]

