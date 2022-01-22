FROM php:8.0

RUN apt-get update && apt-get install -y build-essential
RUN apt-get update && apt-get install -y gnupg
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash -
RUN apt-get update && apt-get install -y nodejs

RUN apt-get update -q -y \
    && apt-get install -q -y wget \
        git \
        libicu-dev \
        bash-completion \
        imagemagick \
        zlib1g-dev \
	libzip-dev

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN docker-php-ext-install intl
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo_mysql

RUN echo "date.timezone=Europe/Paris" >> "/usr/local/etc/php/php.ini"
RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/php.ini

ARG uid=1008

RUN usermod -u ${uid} www-data
