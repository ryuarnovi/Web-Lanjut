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
    # Install Tailwind CLI (Auto-detect architecture)
    ARCH=$(uname -m); \
    if [ "$ARCH" = "x86_64" ]; then \
        TW_BINARY="tailwindcss-linux-x64"; \
    elif [ "$ARCH" = "aarch64" ] || [ "$ARCH" = "arm64" ]; then \
        TW_BINARY="tailwindcss-linux-arm64"; \
    else \
        echo "Unsupported architecture: $ARCH"; exit 1; \
    fi; \
    curl -sLO "https://github.com/tailwindlabs/tailwindcss/releases/latest/download/$TW_BINARY" && \
    chmod +x "$TW_BINARY" && \
    mv "$TW_BINARY" /usr/local/bin/tailwindcss; \
    # Install Composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/*

# Copy project files
COPY . .

# Ensure permissions and install dependencies
RUN mkdir -p writable && chown -R www-data:www-data writable
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-interaction --optimize-autoloader

# Build Tailwind CSS (Production)
RUN tailwindcss -i public/assets/css/input.css -o public/assets/css/app.css --minify

# Adjust Apache configuration for CodeIgniter's public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
