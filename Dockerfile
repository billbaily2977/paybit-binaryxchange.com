FROM php:8.2-fpm

# Install nginx + PHP extensions
RUN apt-get update && apt-get install -y \
    nginx \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql gd \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /var/www/html

# Copy all your app files
COPY . .

# Copy nginx config
COPY nginx.conf /etc/nginx/sites-available/default

# Make nginx listen on Render's $PORT
RUN sed -i 's/listen 80;/listen $PORT;/' /etc/nginx/sites-available/default

# Expose port
EXPOSE 10000

# Start php-fpm and nginx
CMD service php8.2-fpm start && nginx -g "daemon off;"
