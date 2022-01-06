FROM php:8.1-fpm

COPY composer-setup.sh /composer-setup.sh
RUN chmod +x /composer-setup.sh
RUN /composer-setup.sh
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN chown 1000:1000 /usr/local/bin/composer
RUN rm composer-setup.php

RUN apt-get update \
    && apt-get install -y libzip-dev git zip unzip

RUN docker-php-ext-install bcmath calendar exif gettext mysqli pcntl pdo_mysql shmop sockets sysvmsg sysvsem sysvshm zip

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/bin/
RUN install-php-extensions uuid gmp soap uopz intl

RUN groupadd dev -g 1000
RUN useradd dev -g dev -d /home/dev -m
