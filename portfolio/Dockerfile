FROM php:8.1.3-fpm
RUN apt-get update && apt-get install -y libzip-dev && docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN pecl install xdebug && docker-php-ext-enable xdebug
