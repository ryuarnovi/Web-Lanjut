FROM php:8.4-apache

# Set working directory
WORKDIR /var/www/html

# Update and install dependencies with retries and a more stable mirror if needed
# Also adding clean up for smaller image size
RUN set -ex; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        curl \
        ca-certificates \
        libicu-dev \
        libpng-dev \
        libzip-dev \
        zip \
        unzip; \
    docker-php-ext-install intl gd zip mysqli pdo_mysql; \
    a2enmod rewrite; \
    # Install Tailwind CLI (Linux arm64)
    curl -sLO https://github.com/tailwindlabs/tailwindcss/releases/latest/download/tailwindcss-linux-arm64; \
    chmod +x tailwindcss-linux-arm64; \
    mv tailwindcss-linux-arm64 /usr/local/bin/tailwindcss; \
    # Install Composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/*

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev || true

# Build Tailwind CSS
RUN tailwindcss -i public/assets/css/input.css -o public/assets/css/app.css

# Adjust Apache configuration for CodeIgniter's public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Set permissions for writable directory
RUN chown -R www-data:www-data writable

EXPOSE 80
