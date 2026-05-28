FROM php:8.2-fpm

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

WORKDIR /var/www/html
COPY . .
COPY nginx.conf /etc/nginx/sites-available/default

EXPOSE 10000

CMD envsubst '$PORT' < /etc/nginx/sites-available/default > /etc/nginx/sites-enabled/default \
    && nginx -t \
    && php-fpm -D \
    && nginx -g "daemon off;"
