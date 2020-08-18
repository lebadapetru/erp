####################
#PHP FPM target
####################
FROM php:7.4-fpm-alpine as base

#COPY ./ /var/www/erp

WORKDIR /var/www/erp

#enable repository packages
#RUN echo http://dl-cdn.alpinelinux.org/alpine/v$(cat /etc/alpine-release | cut -d'.' -f1,2)/community >> /etc/apk/repositories
#install usermod
RUN apk --no-cache add shadow && usermod -u 1000 www-data
RUN chown -R www-data:www-data /var/cache
RUN chown -R www-data:www-data /var/log

#COPY ./ /var/www/erp
#RUN usermod -u 1000 www-data
#RUN chown -R www-data:www-data /var/cache
#RUN chown -R www-data:www-data /var/log

RUN apk update && apk add build-base

RUN apk add --no-cache \
    postgresql \
    postgresql-dev \
    libzip-dev \
    zlib-dev \
    git \
    zip \
    g++ \
    gettext \
    gettext-dev \
    icu-dev\
    php7-intl \
    nodejs \
    nodejs-npm \
&& docker-php-ext-install \
    pdo_pgsql \
    pgsql \
    gettext \
    intl \
    opcache \
    zip \
&& docker-php-ext-configure intl \
&& docker-php-ext-configure gettext \
&& docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
&& docker-php-ext-enable opcache

COPY ./docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY ./docker/php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.conf

# Install Composer
COPY --from=composer:1.10.9 /usr/bin/composer /usr/bin/composer
# Install composer parallel download plugin, greatly speeds up composer install
RUN composer global require --no-ansi --no-interaction hirak/prestissimo


####################
#Composer targer
####################
FROM base as composer
