FROM bitnami/apache:latest


#RUN apt update
RUN apt -y install php php-common
RUN apt -y install php-cli php-fpm php-json php-pdo php-mysql php-zip php-gd  php-mbstring php-curl php-xml php-pear php-bcmath
RUN apt -y install libapache2-mod-php
RUN apt-get install iputils-ping libcap2 libcap2-bin libpam-cap -y
RUN apt install nano -y
#RUN apt-get upgrade -y


RUN a2enmod rewrite


RUN mkdir /opt/provisioning
RUN chmod 777 /opt/provisioning

# Añadimos un volumen
VOLUME /var/www/html


# Exponemos puerto apache.
EXPOSE 8080 8443


CMD apachectl -D FOREGROUND