# IMAGEN APACHE+PHP7.2+PROFTPD
FROM fcomarcet1/apache-php:v2.0

MAINTAINER Francisco Marcet <fcomarcet1@gmail.com>

RUN apt-get update -qq && \
	apt-get install -y proftpd && \
	apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
RUN apt-get upgrade -y
RUN apt install nano -y

# Activamos apache mods.
RUN a2enmod rewrite

# Añadimos un volumen
#VOLUME /var/www/html

#Exponemos el contenedor a los puertos para que escuche
EXPOSE 21
EXPOSE 22
EXPOSE 80
#puertos conexiones pasivas
EXPOSE 20020-20080

#Añadimos los ficheros necesarios
ADD proftpd.conf /etc/proftpd/proftpd.conf

#RUN mkdir /home/usersftp
#RUN chmod 777 /home/usersftp

# Actualizar the default apache site con nuestra conf.
#ADD www.conf /etc/apache2/sites-available/www.conf
#RUN a2ensite www.conf && a2dissite 000-default.conf

# By default start up ftpd in the foreground.
CMD ["proftpd", "--nodaemon"]