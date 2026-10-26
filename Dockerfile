FROM php:8.2-cli

# Install dependencies sistem
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
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

# Salin .env.example menjadi .env jika .env belum ada
RUN cp .env.example .env || true

# Install dependency PHP via composer TANPA menjalankan scripts otomatis
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Generate App Key dan jalankan dump-autoload secara manual
RUN php artisan key:generate --force
RUN composer dump-autoload --optimize

# Render menggunakan port 10000 secara default
EXPOSE 10000

# Jalankan server Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000