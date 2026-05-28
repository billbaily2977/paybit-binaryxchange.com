FROM php:8.2-apache

# Enable mod_rewrite for clean URLs
RUN a2enmod rewrite

# Install PHP extensions for Postgres + common stuff
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_pgsql pgsql zip

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set working dir
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Point Apache to /public folder
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
