FROM php:7.3-fpm-stretch

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    libmcrypt-dev \
    mysql-client \
    openssh-client \
    zlib1g-dev \
    ssh \
    git \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    unzip \
    cron \
    vim \
    libmagickwand-dev \
    imagemagick \
    supervisor \
    libzip-dev

RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/

RUN docker-php-ext-install pdo_mysql \
    zip \
    gd \
    exif \
    pcntl \
    gettext \
    sockets

RUN apt-get update && apt-get install -y libc-client-dev libkrb5-dev && rm -r /var/lib/apt/lists/*
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install imap

RUN export EDITOR="/usr/bin/vim"

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

RUN mv composer.phar /usr/local/bin/composer

# Install Imagick
RUN pecl install imagick

RUN curl -sL https://deb.nodesource.com/setup_10.x | bash -
RUN apt-get install -y nodejs
RUN npm install -g npm

#Custom php stuff
ADD ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

# Intall supervisor
ADD ./docker/php/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 9000

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
