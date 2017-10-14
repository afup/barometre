FROM php:5.6

RUN apt-get update && apt-get install -y build-essential
RUN curl -sL https://deb.nodesource.com/setup_6.x | bash -
RUN apt-get update && apt-get install -y nodejs


RUN npm install -g grunt-cli

RUN gpg --keyserver hkp://keys.gnupg.net --recv-keys 409B6B1796C275462A1703113804BB82D39DC0E3 7D2BAF1CF37B13E2069D6956105BD0E739499BDB
RUN curl -L https://get.rvm.io | bash -s stable
RUN /bin/bash -l -c "rvm requirements"
RUN /bin/bash -l -c "rvm install 1.9.3"
RUN /bin/bash -l -c "gem install bundler --no-ri --no-rdoc"
RUN /bin/bash -l -c "rvm rvmrc warning ignore allGemfiles"

RUN apt-get update && apt-get install -y wget
RUN apt-get update && apt-get install -y git

RUN apt-get update && apt-get install -y libicu-dev
RUN docker-php-ext-install intl
RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo_mysql
RUN apt-get update && apt-get install -y bash-completion

RUN echo "date.timezone=Europe/Paris" >> "/usr/local/etc/php/php.ini"
RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/php.ini

ARG uid=1008
ARG gid=1008

RUN groupadd -g ${gid} localUser \
    && useradd -u ${uid} -g ${gid} -m -s /bin/bash localUser

RUN usermod -a -G www-data localUser
