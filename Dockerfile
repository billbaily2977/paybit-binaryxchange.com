FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install common PHP extensions you might need
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring zip gd opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite for Laravel, CodeIgniter, etc.
RUN a2en
