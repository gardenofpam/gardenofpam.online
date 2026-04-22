FROM php:8.3-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    nginx \
    curl \
    zip \
    unzip \
    git \
    libpq-dev \
    libicu-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql intl zip

# Install Node and build assets
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN npm install && npm run build

RUN composer install --no-dev --optimize-autoloader

COPY ./docker/nginx.conf /etc/nginx/sites-available/default

RUN chmod -R 777 storage bootstrap/cache \
    && chmod -R 777 /tmp \
    && mkdir -p storage/framework/views \
    && mkdir -p storage/framework/cache \
    && mkdir -p storage/framework/sessions \
    && chmod -R 777 storage/framework

EXPOSE 10000

CMD service nginx start && php artisan config:clear && php artisan view:clear && php artisan migrate --force && php artisan db:seed --class=AdminSeeder --force && php-fpm