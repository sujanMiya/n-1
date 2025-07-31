FROM php:8.3-fpm-alpine

# Define build args
ARG UID=1000
ARG GID=1000
ARG APP_DIR=/var/www/app

# Setup working directory
WORKDIR ${APP_DIR}

# Install dependencies
RUN set -ex && \
    apk --no-cache add \
    postgresql-dev \
    make \
    shadow \
    bash \
    sudo

# Add Alpine Repositories
RUN rm -f /etc/apk/repositories && \
    echo "http://dl-cdn.alpinelinux.org/alpine/v3.18/main" >> /etc/apk/repositories && \
    echo "http://dl-cdn.alpinelinux.org/alpine/v3.18/community" >> /etc/apk/repositories

# iconv fix for Alpine
RUN apk add --no-cache --repository http://dl-cdn.alpinelinux.org/alpine/edge/community/ gnu-libiconv
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so php

# Additional tools and PHP deps
RUN apk add --no-cache \
    php82-pear \
    libwebp-dev \
    libzip-dev \
    libjpeg-turbo-dev \
    libjpeg-turbo \
    libpng-dev \
    libxpm-dev \
    php82-dev gcc \
    zlib-dev \
    curl-dev \
    imagemagick \
    imagemagick-dev \
    freetype-dev \
    icu-dev \
    g++ \
    npm \
    zip \
    vim \
    nano \
    git \
    build-base

# PHP extensions
RUN docker-php-ext-install -j"$(nproc)" \
    curl \
    pgsql \
    pdo \
    pdo_pgsql \
    bcmath \
    zip

RUN docker-php-ext-configure intl && docker-php-ext-install intl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp && docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-configure pcntl --enable-pcntl && docker-php-ext-install pcntl

# Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Imagick installation
RUN git clone https://github.com/Imagick/imagick.git --depth 1 /tmp/imagick && \
    cd /tmp/imagick && \
    phpize && \
    ./configure && \
    make && \
    make install && \
    docker-php-ext-enable imagick && \
    rm -rf /tmp/imagick

# OPCache
RUN docker-php-ext-configure opcache --enable-opcache && docker-php-ext-install opcache

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Create app user matching host UID and GID
RUN addgroup -g ${GID} appgroup && \
    adduser -D -u ${UID} -G appgroup appuser

# Set permissions for application directory
RUN mkdir -p ${APP_DIR}/bootstrap/cache ${APP_DIR}/storage/logs && \
    chown -R appuser:appgroup ${APP_DIR} && \
    chmod -R ug+rw ${APP_DIR}

# Copy custom entrypoint script if needed
COPY start.sh /usr/bin/startx.sh
RUN chmod +x /usr/bin/startx.sh

# Use appuser going forward
USER appuser

# Expose PHP-FPM port
EXPOSE 9000

CMD ["php-fpm"]
