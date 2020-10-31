#!/bin/bash

PATHFTPPROVISONING="/opt/provisioning"
FTPATH=""

# ejecutamos script provisoningFtp 2º plano
/usr/local/bin/php $PATHFTPPROVISONING/provisioningFtp.php

#exec proftpd --nodaemon