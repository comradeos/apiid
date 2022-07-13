FROM php:8.1.8-apache-bullseye
WORKDIR /var/www/html/

RUN apt update
RUN apt install git -y
RUN apt install mc -y
RUN apt install vim -y

RUN docker-php-ext-install mysqli pdo pdo_mysql

# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer