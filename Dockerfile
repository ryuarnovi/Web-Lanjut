FROM php:8.4-apache

# Set working directory
WORKDIR /var/www/html

# Install system dependencies & PHP extensions
RUN set -ex; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
        curl \
        ca-certificates \
        libicu-dev \
        libpng-dev \
        libzip-dev \
        zip \
        unzip \
        gnupg; \
    docker-php-ext-install intl gd zip mysqli pdo_mysql; \
    a2enmod rewrite; \
    # Install Node.js 20.x
    mkdir -p /etc/apt/keyrings; \
    curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg; \
    echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_20.x nodistro main" | tee /etc/apt/sources.list.d/nodesource.list; \
    apt-get update; \
    apt-get install nodejs -y; \
    # Install Composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/*

# Copy package files first for better caching
COPY package*.json ./
COPY composer.* ./

# Install dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-interaction --no-scripts --no-autoloader
RUN npm install

# Copy project files
COPY . .

# Finalize composer
RUN composer dump-autoload --optimize

# Ensure permissions
RUN mkdir -p writable && chown -R www-data:www-data writable

# Build Tailwind CSS (Production)
RUN npm run build

# Adjust Apache configuration for CodeIgniter's public folder
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
