#!/bin/bash

if [ $# -eq 0 ]
then
	echo " USO: $0 <user_ftp> "
	exit
fi



#DOMINIO=$1
FTP=$1
#ver ruta ftpd.passwd

FTP="/etc/proftpd/ftpd.passwd"
FTPTMP="/etc/proftpd/ftpd.passwd.tmp"


#HOSTS="/etc/hosts"
#HOSTSTMP="/etc/hosts.tmp"
#HOSTS="/home/fcomarcet/Escritorio/hostts"
#HOSTSTMP="/home/fcomarcet/Escritorio/hostts.tmp"
# Recibo como parametro el nombre del dominio
#cat $HOSTS | grep -v $DOMINIO  > $HOSTSTMP


cat $FTP | grep -v $FTPUSER  > $FTPTMP


mv $FTPTMP $FTP




