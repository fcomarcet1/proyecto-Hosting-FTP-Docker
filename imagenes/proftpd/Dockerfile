FROM danibascon/proftpd:latest

#Instalamos las depence
RUN apt-get update -y
RUN apt install nano php libapache2-mod-php -y
RUN apt-get upgrade -y

#Añadimos los ficheros necesarios
ADD proftpd.conf /etc/proftpd/proftpd.conf

#ADD cmd.sh /cmd.sh
#Añadimos el permiso de ejecución
#RUN chmod +x /cmd.sh
#ADD prov.php /prov.php

# Añadimos un volumen
VOLUME /var/www/html

#Exponemos el contenedor a los puertos para que escuche
EXPOSE 21
EXPOSE 22

CMD ["proftpd", "--nodaemon"]
#Ejecutamos el script
#ENTRYPOINT /cmd.sh