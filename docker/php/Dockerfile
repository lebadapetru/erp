####################
#PHP FPM target
####################
FROM php:7.4-fpm-alpine as base

#COPY ./ /var/www/erp

WORKDIR /var/www/erp

RUN apk update && apk add build-base

#configure timezone
RUN apk --no-cache add tzdata
RUN cp /usr/share/zoneinfo/Europe/Athens /etc/localtime
RUN echo "Europe/Athens" > /etc/timezone

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
    libjpeg-turbo-dev \
    jpeg-dev \
    libpng-dev \
    imagemagick \
    imagemagick-dev \
    ffmpeg \
    perl-image-exiftool \
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
&& docker-php-ext-enable opcache \
&& pecl install imagick \
&& docker-php-ext-enable imagick

#RUN git clone https://github.com/Imagick/imagick
#RUN cd imagick
#RUN ls
#RUN phpize && ./configure
#RUN make
#RUN make install
#RUN cd ../
#RUN rm -rf imagick
#RUN docker-php-ext-enable imagick

# ImageMagick config
COPY docker/php/policy.xml /etc/ImageMagick-6/policy.xml

COPY ./docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini
COPY ./docker/php/uploads.ini /usr/local/etc/php/conf.d/uploads.ini
COPY ./docker/php/php-fpm.conf /usr/local/etc/php-fpm.conf

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

####################
#Composer targer
####################
FROM base as composer
