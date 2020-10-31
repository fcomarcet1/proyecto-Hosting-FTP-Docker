#ARG php_version

#FROM php:${php_version}

FROM php:apache

RUN docker-php-ext-install mysqli 

RUN a2enmod rewrite
#ADD www.conf /etc/apache2/sites-available/
CMD apachectl -D FOREGROUND