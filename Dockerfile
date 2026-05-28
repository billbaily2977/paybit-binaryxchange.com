FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libicu-dev \
    && docker-php-ext-install pdo_mysql mbstring gd zip intl opcache \
    && pecl install redis \
    && docker-php-ext-enable redis \
    && apt-get clean && rm -rf /var/lib/apt/lists/*
