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

# Set Environment Variables untuk Composer agar tidak memory limit & diizinkan untuk superuser
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1

# Set working directory
WORKDIR /app

# Copy seluruh file project ke dalam container
COPY . /app

# Install dependency PHP via composer dengan flag verbose (-v) agar error aslinya terlihat jika gagal lagi
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Render menggunakan port 10000 secara default
EXPOSE 10000

# Jalankan server Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000