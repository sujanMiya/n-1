FROM php:8.4-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    libpng-dev \
    libzip-dev \
    postgresql-dev \
    curl \
    git \
    unzip

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_pgsql pgsql gd zip opcache bcmath

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Expose port 9000 for PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]