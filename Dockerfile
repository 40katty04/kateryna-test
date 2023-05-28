FROM php:8.1-apache

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . /var/www/html
COPY ./apache.conf /etc/apache2/sites-available/000-default.conf

RUN composer install

RUN chown -R www-data:www-data /var/www/html/

RUN a2enmod rewrite

CMD apachectl -D FOREGROUND
