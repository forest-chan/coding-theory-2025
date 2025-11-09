FROM composer:2.7

WORKDIR /var/www/html

CMD bash -c "composer install"
