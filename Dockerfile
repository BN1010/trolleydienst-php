FROM ubuntu:20.04

ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update \
  && apt-get install -y \
  composer \
  git \
  php \
  neovim

RUN mkdir /trolleydienst-php \
  && git clone https://github.com/trolleydienst/trolleydienst-php.git /trolleydienst-php/app \
  && chown -R www-data:www-data /trolleydienst-php \
  && sed -i 's|/var/www/html|/trolleydienst-php/app/public|' /etc/apache2/sites-available/000-default.conf \
  && sed -i 's|/var/www/|/trolleydienst-php/app/|' /etc/apache2/apache2.conf

RUN usermod -d /trolleydienst-php -s /bin/bash www-data

EXPOSE 80
WORKDIR /trolleydienst-php/app
CMD ["apachectl", "-D", "FOREGROUND"]
