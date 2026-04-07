FROM php:8.2-cli

# Install dependencies + NodeJS 18
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip sqlite3 libsqlite3-dev \
    && curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install zip pdo pdo_sqlite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Install backend
RUN composer install --no-dev --optimize-autoloader

# 🔥 Install frontend & build Vite
RUN npm install
RUN npm run build

# 🔥 DEBUG (biar tau build berhasil)
RUN ls -la public/build

# SQLite
RUN mkdir -p database && \
    touch database/database.sqlite && \
    chmod -R 777 database

# Permission
RUN chmod -R 777 storage bootstrap/cache

RUN chown -R www-data:www-data storage bootstrap/cache

# Clear cache
RUN php artisan config:clear && \
    php artisan route:clear && \
    php artisan view:clear && \
    php artisan migrate --force

EXPOSE 10000

CMD php -S 0.0.0.0:10000 -t public