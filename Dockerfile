# Build frontend assets
FROM node:22 AS node_builder
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
FROM php:8.4-cli
ENV PORT=8000
WORKDIR /app

# System deps for Laravel + Postgres
RUN apt-get update \
 && apt-get install -y git unzip curl libpq-dev libzip-dev libpng-dev libjpeg62-turbo-dev libwebp-dev libonig-dev libxml2-dev \
 && docker-php-ext-configure gd --with-jpeg --with-webp \
 && docker-php-ext-install pdo_pgsql gd exif zip mbstring xml \
 && rm -rf /var/lib/apt/lists/*

# Upload fino a 10MB (foto da telefono, PDF bilanci); il default PHP è 2MB
RUN printf "upload_max_filesize=12M\npost_max_size=14M\nmemory_limit=256M\n" > /usr/local/etc/php/conf.d/uploads.ini

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

CMD sh -c "\
  if [ -z \"$APP_KEY\" ]; then echo 'APP_KEY is missing; set it in Render env vars.' >&2; exit 1; fi; \
  mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views bootstrap/cache; \
  chmod -R 775 storage bootstrap/cache; \
  php artisan migrate --force --no-interaction && php artisan optimize && php artisan storage:link; \
  php -S 0.0.0.0:${PORT:-8000} -t public"
