FROM php:8.4-cli

# Install dependencies sistem & Node.js (diperlukan untuk build Vite)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip fileinfo dom xml

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set Environment Variables untuk Composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

# Set working directory
WORKDIR /app

# Copy seluruh file project ke dalam container
COPY . /app

# Install dependency PHP via composer
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Install dependency Node.js dan Build Vite (CSS/JS)
RUN npm install && npm run build

# Jalankan dump-autoload secara manual
RUN composer dump-autoload --optimize

# Render menggunakan port 10000 secara default
EXPOSE 10000

# Bersihkan cache, jalankan migrasi database Aiven, lalu jalankan server
CMD php artisan config:clear && php artisan cache:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000