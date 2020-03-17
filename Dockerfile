FROM php:7.4.3-apache

RUN docker-php-ext-install -j$(nproc) mysqli \
    && docker-php-ext-install -j$(nproc) pdo \
    && docker-php-ext-install -j$(nproc) pdo_mysql

RUN apt-get update && \
    apt-get install -y --no-install-recommends git zip

#configurate php
RUN echo "\
error_reporting = -1\n \
display_errors = On\n \
display_startup_errors = On\n \
upload_max_filesize = 100M\n \
memory_limit = 1024M\n \
date.timezone = Europe/Berlin\n" \
> /usr/local/etc/php/php.ini

# install composer
RUN curl -O https://getcomposer.org/installer && php installer --install-dir=/usr/local/bin --filename=composer && rm installer

