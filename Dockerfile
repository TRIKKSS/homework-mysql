FROM php:8.0-apache

RUN docker-php-ext-install mysqli && docker-php-ext-install pdo_mysql

EXPOSE 80

WORKDIR /var/www/html

COPY www /var/www/html

RUN chmod 777 /var/www/html/images/poster_film/

RUN chown -R www-data:www-data .