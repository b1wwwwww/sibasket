FROM php:8.2-cli

# Install dependencies sistem yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy seluruh file project ke dalam container
COPY . /app

# Install dependency PHP via composer
RUN composer install --no-dev --optimize-autoloader

# Render menggunakan port dinamis atau port 10000 secara default
EXPOSE 10000

# Jalankan server Laravel
CMD php artisan serve --host=0.0.0.0 --port=10000