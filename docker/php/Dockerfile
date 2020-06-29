# ./docker/php/Dockerfile
FROM php:7.4-fpm-alpine

RUN apk update && apk add build-base

RUN apk add postgresql postgresql-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && docker-php-ext-install opcache \
    && docker-php-ext-enable opcache

RUN apk add libzip-dev zlib-dev git zip \
  && docker-php-ext-install zip

RUN apk add bash

RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
&& curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
# Make sure we're installing what we think we're installing!
&& php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
&& php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --snapshot \
&& rm -f /tmp/composer-setup.*

EXPOSE 9000


COPY ./docker/php/opcache.ini /usr/local/etc/php/conf.d/opcache.ini
COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

COPY ./ /var/www/erp

WORKDIR /var/www/erp

#RUN composer install

#install usermod
#RUN echo http://dl-2.alpinelinux.org/alpine/edge/community/ >> /etc/apk/repositories
#RUN apk --no-cache add shadow && usermod -u 1000 www-data

#RUN composer install

#ENV PATH="~/.composer/vendor/bin:./vendor/bin:${PATH}"

#RUN usermod -u 1000 www-data
#RUN chown -R www-data:www-data /var/cache
#RUN chown -R www-data:www-data /var/log
