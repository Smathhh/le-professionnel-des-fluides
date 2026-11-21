# Stage 1: Build frontend assets with Vite
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources ./resources
COPY vite.config.js ./
RUN npm run build

# Stage 2: Production PHP 8.3 runtime
FROM php:8.3-cli-alpine

RUN apk add --no-cache \
    bash \
    sqlite \
    sqlite-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    freetype-dev \
    icu-dev \
    oniguruma-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install pdo pdo_sqlite mbstring gd intl zip opcache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

COPY . .
COPY --from=assets /app/public/build ./public/build
RUN php artisan package:discover --ansi

RUN chmod +x /var/www/html/docker/start.sh \
    && mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs storage/app/public database/nosql_data/media \
    && chmod -R 775 storage bootstrap/cache database

EXPOSE 8000

CMD ["/var/www/html/docker/start.sh"]
