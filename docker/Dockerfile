ARG PHP_VERSION

FROM objectsystems/php:${PHP_VERSION}
MAINTAINER Web Team <phpteam@objectsystems.com>

RUN apt-get update && apt-get install --allow-unauthenticated -y \
        git \
        curl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && mkdir -p /var/www && chown -R www-data: /var/www

