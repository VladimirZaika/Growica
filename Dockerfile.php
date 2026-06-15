FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libzip-dev \
    zip \
    unzip

RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp

RUN docker-php-ext-install \
    gd \
    mysqli \
    pdo \
    pdo_mysql \
    zip

COPY ./docker/uploads.ini /usr/local/etc/php/conf.d/uploads.ini

WORKDIR /var/www/html