FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev zip sqlite3 \
    && docker-php-ext-install zip pdo pdo_sqlite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy project
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# 🔥 FIX SQLITE
RUN touch database/database.sqlite

# 🔥 FIX PERMISSION
RUN chmod -R 775 storage bootstrap/cache

# 🔥 CLEAR & OPTIMIZE
RUN php artisan config:clear && \
    php artisan cache:clear && \
    php artisan view:clear && \
    php artisan route:clear

# 🔥 MIGRATE DATABASE
RUN php artisan migrate --force

# Expose port
EXPOSE 10000

# Run Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000