ARG php_version

FROM php:${php_version}

#FROM php:apache

RUN apt-get update
RUN docker-php-ext-install mysqli 
RUN apt-get install iputils-ping libcap2 libcap2-bin libpam-cap -y
RUN apt install nano -y
RUN apt-get upgrade -y

# Creamos directorios
RUN mkdir /opt/provisioning
RUN chmod 777 /opt/provisioning

RUN mkdir /etc/extrahosts.d
RUN chmod 777 /etc/extrahosts.d

# añadimos fichero necesarios
ADD hosts.d /etc/extrahosts.d
RUN chmod 777 /etc/extrahosts.d/hosts.d

ADD hosts.copy /etc/extrahosts.d
RUN chmod 777 /etc/extrahosts.d/hosts.copy


# Añadimos scripts

ADD provisioningVhosts.php /opt/provisioning/provisioningVhosts.php
RUN chmod 777 /opt/provisioning/provisioningVhosts.php

ADD copy_hosts.sh /opt/provisioning/copy_hosts.sh
RUN chmod +x /opt/provisioning/copy_hosts.sh

ADD entrypoint_vhost.sh /entrypoint_vhost.sh
RUN chmod +x /entrypoint_vhost.sh

ADD remove_hosts.sh /opt/provisoning/remove_hosts.sh
RUN chmod +x /opt/provisoning/remove_hosts.sh

ADD remove_hostsd.sh /opt/provisoning/remove_hostsd.sh
RUN chmod +x /opt/provisoning/remove_hostsd.sh


# Añadimos un volumenes
VOLUME /var/www/html
VOLUME /etc

# activamos mod apache
RUN a2enmod rewrite

# exponemos puerto contenedor
EXPOSE 80

#ENTRYPOINT ["/opt/provisioning/run_vhosts.sh"]
ENTRYPOINT /entrypoint_vhost.sh

CMD apachectl -D FOREGROUND