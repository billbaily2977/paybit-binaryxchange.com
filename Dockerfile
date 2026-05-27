FROM php:8.2-fpm

RUN apt-get update && apt-get install -y nginx \
    libpq-dev libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql gd

WORKDIR /var/www/html
COPY . .

COPY nginx.conf /etc/nginx/sites-available/default
RUN sed -i 's/listen 80;/listen $PORT;/' /etc/nginx/sites-available/default

EXPOSE 10000

CMD service php8.2-fpm start && nginx -g "daemon off;"
