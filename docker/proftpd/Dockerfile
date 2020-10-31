

# IMAGEN APACHE+PHP7.3+PROFTPD
ARG php_version
FROM php:${php_version}
#FROM fcomarcet1/apache-php:v3.0

MAINTAINER Francisco Marcet <fcomarcet1@gmail.com>

#RUN apt-get update -qq && \
#	apt-get install -y proftpd && \
#	apt-get clean && \
#    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
#RUN apt-get upgrade -y
#RUN apt install nano -y

RUN apt-get update
#RUN apt-get install php7.3-mysqli 
RUN	apt-get install proftpd -y
RUN docker-php-ext-install mysqli 
RUN apt-get install iputils-ping libcap2 libcap2-bin libpam-cap -y
RUN apt install nano -y
RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
RUN apt-get upgrade -y 



# Activamos apache mods.
#RUN a2enmod rewrite

#Añadimos los ficheros proftpd
ADD proftpd.conf /etc/proftpd/proftpd.conf
ADD ftpd.passwd /etc/proftpd/ftpd.passwd
RUN chmod 440 /etc/proftpd/ftpd.passwd

ADD ftpd.group /etc/proftpd/ftpd.group
RUN chmod 440 /etc/proftpd/ftpd.group

RUN mkdir /srv/ftpusers
RUN chmod 777 /srv/ftpusers

RUN mkdir /opt/provisioning
RUN chmod 777 /opt/provisioning

#Añadimos los ficheros script
ADD entrypoint_ftp.sh /entrypoint_ftp.sh
RUN chmod +x /entrypoint_ftp.sh


#ADD remove_ftp.sh /opt/provisioning/
#RUN chmod 755 /opt/provisioning/remove_ftp.sh

WORKDIR /opt/provisioning

# Añadimos un volumen
VOLUME /var/www/html
VOLUME /srv/ftpusers

#Exponemos el contenedor a los puertos para que escuche
EXPOSE 21
EXPOSE 22
EXPOSE 80

#puertos conexiones pasivas
EXPOSE 20020-20080


#Ejecutamos el script
#ENTRYPOINT ["/entrypoint_ftp.sh"]

# iniciamos proftpd 
CMD ["proftpd", "--nodaemon"]


# By default start up ftpd in the foreground.
#CMD ["proftpd", "--nodaemon"]