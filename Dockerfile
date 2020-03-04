FROM php:7.0-apache
#FROM php:7.1-fpm

RUN apt-get update -y 
RUN apt-get install -y vim less
RUN set -ex apk --no-cache add postgresql-dev libpq-dev
RUN apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring \
    && docker-php-ext-enable pdo pdo_pgsql pgsql 
RUN pecl install redis-3.1.0 \
    && docker-php-ext-enable redis

EXPOSE 80

