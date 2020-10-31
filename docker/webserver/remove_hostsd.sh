#!/bin/bash

if [ $# -eq 0 ]
then
	echo " USO: $0 <nombre_dominio> "
	exit
fi


DOMINIOD=$1
HOSTSD="/etc/extrahosts.d/hosts.d"
HOSTSDTMP="/etc/extrahosts.d/hosts.d.tmp"

# Recibo como parametro el nombre del dominio DOMINIOD
cat $HOSTSD | grep -v $DOMINIOD  > $HOSTSDTMP

cat $HOSTSDTMP > $HOSTSD

#mv $HOSTSDTMP $HOSTSD