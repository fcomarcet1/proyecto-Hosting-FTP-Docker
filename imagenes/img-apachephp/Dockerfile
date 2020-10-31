# IMAGEN APACHE+PHP7.2
FROM ubuntu:18.04
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update -y
RUN apt install -y apache2 libapache2-mod-php7.2 nano python php7.2 
RUN apt-get upgrade -y

# Activamos apache mods.
RUN a2enmod rewrite

# Añadimos un volumen
VOLUME /var/www/html

# Exponemos puerto apache.
EXPOSE 80

ADD ./www /var/www/html
ADD www.conf /etc/apache2/sites-available/


# Actualizar the default apache site con nuestra conf.
#ADD www.conf /etc/apache2/sites-available/www.conf
#0RUN a2ensite www.conf && a2dissite 000-default.conf

# By default start up apache in the foreground, override with /bin/bash for interative.
#CMD apachectl -D FOREGROUND