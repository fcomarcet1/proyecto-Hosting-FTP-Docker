#!/bin/bash

if [ $# -eq 0 ]
then
	echo " USO: $0 <nombre_dominio> "
	exit
fi

DOMINIO=$1
HOSTS="/etc/hosts"
HOSTSTMP="/etc/extrahosts.d/hosts.copy"

#HOSTS="/home/fcomarcet/Escritorio/hostts"
#HOSTSTMP="/home/fcomarcet/Escritorio/hostts.tmp"

# Recibo como parametro el nombre del dominio

cat $HOSTS | grep -v $DOMINIO  > $HOSTSTMP

cat $HOSTSTMP > $HOSTS

#mv $HOSTSTMP $HOSTS
