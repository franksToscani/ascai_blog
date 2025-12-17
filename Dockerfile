# Build frontend assets
FROM node:20 AS node_builder
WORKDIR /app
COPY package*.json .
RUN npm ci
COPY . .
RUN npm run build

# Install PHP dependencies without dev packages
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --prefer-dist --no-progress --no-scripts --optimize-autoloader

# Final runtime image
FROM php:8.2-cli
ENV PORT=8000
WORKDIR /app

# System deps for Laravel + Postgres
RUN apt-get update \
 && apt-get install -y git unzip curl libpq-dev libzip-dev libpng-dev libonig-dev libxml2-dev \
 && docker-php-ext-install pdo_pgsql gd zip mbstring xml \
 && rm -rf /var/lib/apt/lists/*

# Copy composer from official image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .
# Copy vendor and built assets from previous stages
COPY --from=vendor /app/vendor ./vendor
COPY --from=node_builder /app/public/build ./public/build

# Optimize autoloader (no config cache to avoid APP_KEY issues at build time)
RUN php -r "file_exists('.env') || copy('.env.example', '.env');"

# Create storage symlink
RUN php artisan storage:link || true

EXPOSE 8000

HEALTHCHECK --interval=30s --timeout=5s --start-period=30s --retries=3 \
  CMD curl -f http://127.0.0.1:${PORT:-8000}/ || exit 1

CMD sh -c "php artisan migrate --force --no-interaction && php artisan optimize && php artisan storage:link; php -S 0.0.0.0:${PORT:-8000} -t public"
