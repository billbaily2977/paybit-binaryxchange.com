FROM php:8.2-apache

# Copy everything to Apache's web root
COPY . /var/www/html/

# Fix permissions so Apache can read files
RUN chown -R www-data:www-data /var/www/html

# Apache listens on 80 by default
EXPOSE 80
