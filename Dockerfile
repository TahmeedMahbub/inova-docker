FROM php:7.4.33 as php

RUN apt-get update -y
RUN apt-get install -y libzip-dev zip unzip libpq-dev libcurl4-gnutls-dev zlib1g-dev libpng-dev
RUN docker-php-ext-install pdo pdo_mysql bcmath gd

RUN pecl install -o -f redis zip \
    && rm -rf /tmp/pear \
    && docker-php-ext-enable redis zip

WORKDIR /var/www
COPY . .

COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

ENV PORT=8010
ENTRYPOINT [ "Docker/entrypoint.sh" ]