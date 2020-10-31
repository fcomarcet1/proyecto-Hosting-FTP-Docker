#!/bin/bash

#COPYHOSTS="/home/fcomarcet/Escritorio/hosts"
#COPYHOSTSAVE="/home/fcomarcet/Escritorio/hosts.copy"
#COPYHOSTSD="/home/fcomarcet/Escritorio/hosts.d" 

COPYHOSTS="/etc/hosts"
COPYHOSTTMP="/etc/extrahosts.d/hosts.copy"
COPYHOSTSD="/etc/extrahosts.d/hosts.d"

cat $COPYHOSTS > $COPYHOSTSAVE
cat $COPYHOSTSAVE $COPYHOSTSD > $COPYHOSTS
rm $COPYHOSTSAVE

exec /usr/sbin/apache2 -D FOREGROUND

#exit