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

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader

COPY ./docker/nginx.conf /etc/nginx/sites-available/default

RUN chmod -R 775 storage bootstrap/cache

EXPOSE 10000

CMD service nginx start && php-fpm