FROM php:5.6-apache

RUN apt-get update && apt-get install -y zlibc zlib1g zlib1g-dev
RUN echo "date.timezone=Europe/Paris" >> "/usr/local/etc/php/php.ini"
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mbstring
RUN apt-get update && apt-get install -y libicu-dev build-essential
RUN docker-php-ext-install intl
RUN echo "Include sites-enabled/" >> /etc/apache2/apache2.conf


ARG uid=1008
ARG gid=1008
RUN groupadd -g ${gid} localUser \
    && useradd -u ${uid} -g ${gid} -m -s /bin/bash localUser

RUN usermod -a -G www-data localUser

RUN sed --in-place "s/User \${APACHE_RUN_USER}/User localUser/" /etc/apache2/apache2.conf
RUN sed --in-place  "s/Group \${APACHE_RUN_GROUP}/Group localUser/" /etc/apache2/apache2.conf

COPY apache.conf /etc/apache2/sites-enabled/000-default.conf



