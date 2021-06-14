FROM php:7.2-fpm-alpine as base

RUN apk --update add \
    alpine-sdk \
    openssl-dev \
    php7-pear \
    php7-dev

RUN docker-php-ext-install pdo_mysql

RUN rm -rf /var/cache/apk/*

EXPOSE 9000

# --------------------------------------------------------------------------------------------------------------------

FROM base as development

ENV TZ ${TZ}

RUN pecl channel-update pecl.php.net

RUN apk add --update --upgrade tzdata autoconf g++ make \
    && ln -s /usr/share/zoneinfo/$TZ /etc/localtime \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
