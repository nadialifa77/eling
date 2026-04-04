FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip sqlite3 nodejs npm \
    && docker-php-ext-install zip pdo pdo_sqlite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Install backend
RUN composer install --no-dev --optimize-autoloader

# Install frontend & build Vite
RUN npm install
RUN npm run build

# SQLite
RUN touch database/database.sqlite

# Permission
RUN chmod -R 775 storage bootstrap/cache

# Clear cache (AMAN karena pakai file driver)
RUN php artisan config:clear && \
    php artisan view:clear && \
    php artisan route:clear

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000