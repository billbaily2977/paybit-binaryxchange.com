FROM php:8.2-fpm

# Install nginx and PHP extensions
RUN apt-get update && apt-get install -y \
    nginx \
    gettext-base \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql gd \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy app files
COPY . .

# Copy nginx config
COPY nginx.conf /etc/nginx/sites-available/default

# Test nginx config during build so errors show up
RUN nginx -t

# Expose Render's default port
EXPOSE 10000

# Start php-fpm in background, replace $PORT in nginx config, then start nginx
CMD envsubst '$PORT' < /etc/nginx/sites-available/default > /etc/nginx/sites-enabled/default \
    && php-fpm -D \
    && nginx -g "daemon off;"
