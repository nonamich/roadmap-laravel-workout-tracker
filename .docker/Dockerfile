FROM php:8.3-cli-alpine AS php-base
RUN apk add --no-cache \
    git \
    curl \
    zip \
    unzip
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

FROM php-base AS vendor
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer install --no-scripts  --no-dev --no-interaction --prefer-dist

FROM node:22-alpine AS frontend
WORKDIR /app
COPY package*.json tsconfig*.json vite.config.* ./
RUN npm ci
COPY resources/ resources/
ENV NODE_ENV=production
RUN npm run build

FROM php-base AS laravel-base
WORKDIR /var/www/html
COPY . .
RUN chown -R www-data:www-data ./ && \
    chmod -R 755 ./database && \
    chmod -R 755 ./storage && \
    chmod -R 755 ./bootstrap/cache
COPY --from=vendor /var/www/html/vendor/ vendor/
RUN composer dump-autoload
RUN composer run post-root-package-install
RUN composer run post-create-project-cmd
RUN sed -i '/^JWT_SECRET=/d' .env && echo "JWT_SECRET=$(openssl rand -hex 32)" >> .env

FROM laravel-base AS laravel-queue
CMD [ "php", "artisan", "queue:listen" ]

FROM laravel-base AS laravel-schedule
CMD [ "php", "artisan", "schedule:work" ]

FROM laravel-base AS laravel-serve
COPY --from=frontend /app/public/build/ public/build/
CMD [ "php", "artisan", "serve", "--host", "0.0.0.0" ]
EXPOSE 8000

