FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install zip pdo pdo_pgsql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install
RUN npm run build

RUN chmod -R 777 storage bootstrap/cache

RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear

EXPOSE 10000

CMD php artisan migrate --force && php -S 0.0.0.0:10000 -t public