FROM php:7.1-alpine
RUN apk add --update --no-cache openssl-dev pcre-dev git icu-libs zsh && \
    apk add --no-cache --virtual build-dependencies icu-dev

WORKDIR /usr/src/php/ext
RUN git clone https://github.com/xdebug/xdebug

RUN NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
    docker-php-ext-install -j${NPROC} intl xdebug mysqli pdo_mysql mbstring
RUN apk del --no-cache --purge build-dependencies && \
    rm -rf /tmp/pear

WORKDIR /tmp
RUN if [ ! -e composer.phar ]; then wget http://getcomposer.org/composer.phar; fi && \
    mv composer.phar /usr/bin/composer && \
    chmod 0755 /usr/bin/composer && \
    composer config -g repos.packagist composer https://packagist.jp
