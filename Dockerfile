FROM ubuntu:20.04

ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update \
  && apt-get install -y \
  neovim \
  php

COPY ./ /trolleydienst-php/app
RUN chown -R www-data:www-data /trolleydienst-php \
  && usermod -d /trolleydienst-php -s /bin/bash www-data

RUN sed -i 's|/var/www/html|/trolleydienst-php/app/public|' /etc/apache2/sites-available/000-default.conf \
  && sed -i 's|/var/www/|/trolleydienst-php/app/|' /etc/apache2/apache2.conf \
  && sed -i 's|${APACHE_LOG_DIR}/error.log|/dev/stdout|' /etc/apache2/sites-available/000-default.conf

EXPOSE 80
WORKDIR /trolleydienst-php/app
CMD ["apachectl", "-D", "FOREGROUND"]
