FROM php:7.3-apache

ARG APACHE_UID
ARG APACHE_GID

RUN usermod -u $APACHE_UID www-data
RUN groupmod -g $APACHE_GID www-data

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite

RUN apt update
RUN apt install libcurl4-gnutls-dev -y

RUN docker-php-ext-install mysqli pdo pdo_mysql curl
