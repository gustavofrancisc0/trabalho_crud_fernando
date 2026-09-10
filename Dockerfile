FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

# Copia a aplicação PHP para a pasta pública do Apache
COPY app/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html
