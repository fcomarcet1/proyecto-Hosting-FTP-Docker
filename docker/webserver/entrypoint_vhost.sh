#!/bin/bash

PATHVHOSTPROVISONING="/opt/provisioning"
PATHROOT="/"

#ejecutamos Script copia Vhosts a /etc/hosts
#exec $PATHVHOSTPROVISONING/copy_hosts.sh

$PATHVHOSTPROVISONING/copy_hosts.sh

# ejecutamos script provisoningVhost 2º plano
/usr/local/bin/php $PATHVHOSTPROVISONING/provisioningVhosts.php
 

#exec /usr/sbin/apache2 -D FOREGROUND