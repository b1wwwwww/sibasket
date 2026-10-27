FROM php:8.4-cli

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

# Jangan menimpa environment variables dari Render / runtime.
# Laravel harus membaca variabel env yang dikirim oleh platform.
# JANGAN menyalin .env.example ke .env di build container.

# Install dependency PHP via composer TANPA menjalankan scripts otomatis
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Generate App Key dan jalankan dump-autoload secara manual
RUN php artisan key:generate --force
RUN composer dump-autoload --optimize

# Render menggunakan port 10000 secara default
EXPOSE 10000

# Hapus perintah config:cache dari tahap RUN (build time)
# Ganti CMD di baris paling bawah Dockerfile menjadi seperti ini:

CMD php artisan config:clear && php artisan cache:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=10000