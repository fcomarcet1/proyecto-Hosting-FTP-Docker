<?php

//RUTAS
$path = "/var/www/html";
$path_vhost = "/etc/apache2/sites-available";
$pathconf = "/var/www/html/"; 
$pathhosts = "/etc/hosts";
$path_script_removehosts = "/opt/provisioning/remove_hosts.sh";
$path_script_removehostsd="/opt/provisioning/remove_hostsd.sh";


$ip = "172.20.0.10";  //webserver
$ip_ftp= "172.20.0.9";  //ftp server
$www_dom = "www.";
$ftp_dom="ftp.";


//-------------------------------------------------
//-------------------------------------------------
// FUNCION ALTA HOST
//-------------------------------------------------
//-------------------------------------------------
function dar_alta_host($strDominio){

    global $path, $pathetc, $pathconf, $pathhosts, $path_vhost, $ip, $ip_ftp, $www_dom, $ftp_dom;

    //-------------------------------------------------
    // crear directorio Vhost 
    // $path = "/var/www/html";
    //-------------------------------------------------
    echo "**********************************************************"."\n";		
    echo '**Creando directorio :'.' '.$path.'/'.$strDominio."\n";
    echo "**********************************************************"."\n";
    echo "\n";		
    mkdir($path."/".$strDominio);

    //-------------------------------------------------
    // Permisos directorio Vhost
    // $path = "/var/www/html";
    //-------------------------------------------------
    echo "**********************************************************"."\n";		
    echo '**Modificando permisos en el directorio:' . ' ' . $path .'/'. $strDominio ."\n";
    echo "**********************************************************"."\n";
    echo "\n";
    //chmod($path."/".$strDominio, 0755);		
    chmod($path."/".$strDominio, 0750);
   

    //---------------------------------------------------------------------------------------------
    // archivo de configuracion en /etc/apache2/sites-available/$strDominio.conf------>fran.io.conf
    // $path_vhost = "/etc/apache2/sites-available";
    //---------------------------------------------------------------------------------------------
    echo "**********************************************************"."\n";		
    echo '**Añadiendo fichero de conf en:'. ' ' . "$path_vhost" . ' ' . '...'."\n" ;
    echo "**********************************************************"."\n";	
    echo "\n";	

            $vhost = "\n"."<VirtualHost *:80>
            ServerAdmin webmaster@".$strDominio."
            DocumentRoot ".$path.'/'.$strDominio."
            ServerName ".$strDominio."
            ServerAlias www.".$strDominio."
        </VirtualHost>"."\n";

    echo "\n";
    echo "**********************************************************"."\n";		
    echo '**Generando  fichero .conf'."\n";
    echo "**********************************************************"."\n";		
    echo "$vhost";
    echo "\n";

    //$file = fopen("/etc/apache2/sites-available/test.txt.conf","w")or die ("Unable to open file!");
    $file= fopen($path_vhost."/".$strDominio.".conf","w") or die ("Unable to open file!");
        $a = '<Virtualhost *:80>'."\n";
        fwrite($file,$a);
        $b = "\t".'ServerAdmin  webmaster@'.$strDominio. "\n";
        fwrite($file,$b);
        $c = "\t".'DocumentRoot'." ". $path .'/'. $strDominio."\n";
        fwrite($file,$c);
        $d = "\t".'ServerName'." ". $strDominio."\n";
        fwrite($file,$d);
        $e = "\t".'ServerAlias'." ". $www_dom . $strDominio."\n";
        fwrite($file,$e);
        /*
            METER VARIABLES LOGS/ MODIFICAR DOCKERFILES & VARIABLES ENTORNO
            //falta modificar variables contenedor para logs ${APACHE_LOG_DIR}
            //fwrite($myfile,'ErrorLog ${APACHE_LOG_DIR}..... \n');
            //fwrite($myfile,'CustomLog ${APACHE_LOG_DIR}.....  \n');
        */ 
        $f = '</Virtualhost>'."\n";
        fwrite($file,$f);

    echo "\n";
    echo "**********************************************************"."\n";		
    echo "**Fichero Vhost OK \n";
    echo "**********************************************************"."\n";
    echo "\n";	

    fclose($file);

        //exit(0);    
}

//-------------------------------------------------
//-------------------------------------------------
// FUNCION BAJA HOST
//-------------------------------------------------
//-------------------------------------------------

function dar_baja_host($strDominio){

    global $path, $pathetc, $pathconf, $pathhosts, $path_vhost, $ip, $ip_ftp, $www_dom, $ftp_dom, $path_script_removehosts, $dir_delete,$path_script_removehostsd;

    //-------------------------------------------------
    // eliminamos archivo.conf de sites-available en /etc/apache2/sites-available
    // $path_vhost = "/etc/apache2/sites-available";
    //-------------------------------------------------

    //FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
    $dir_delete=$path_vhost."/".$strDominio.".conf";

    echo "Value dir_delete:$dir_delete"."\n";
    echo "\n";
    echo "********************************************************************************"."\n";		
    echo '**Eliminando el fichero .conf:'.$dir_delete."\n";
    echo "*********************************************************************************"."\n";	
    echo "\n";

    //$dir_delete=$path_vhost."/".$strDominio.".conf";

    // Usamos  la funcion unlink()para eliminar ficheros 
    if (file_exists($dir_delete)) {

        if (unlink($dir_delete)){ 

            echo "\n";
            echo "****************************************************************************"."\n";		
            echo '**Fichero:'. $dir_delete .' '. 'eliminado correctamente'."\n";
            echo "*****************************************************************************"."\n";	
            echo "\n";   
        }
        else{
            echo "\n";
            echo "**********************************************************"."\n";		
            echo '**ERROR no se puedo eliminar fichero:'. $dir_delete ."\n";
            echo "**********************************************************"."\n";	
            echo "\n";      
        }   
    }
    else{
        echo "\n";
        echo "**********************************************************"."\n";		
        echo '**El fichero no existe'."\n";
        echo "**********************************************************"."\n";	
        
    }

                                
    //-------------------------------------------------
    // eliminamos directorio de /var/www/html
    // $path = "/var/www/html";
    //-------------------------------------------------

    //rmdir($path."/".$strDominio);
    $rmdir_delete=$path."/".$strDominio;
    echo "\n";
    echo "**********************************************************"."\n";		
    echo '**Eliminando directorio:'.$rmdir_delete.'...'."\n";
    echo "**********************************************************"."\n";	
    echo "\n";

    //$rmdir_delete=$path."/".$strDominio;

    // Usamos  la funcion unlink()para eliminar ficheros 
    if (file_exists($rmdir_delete)) {

        if (rmdir($rmdir_delete)){ 

            echo "\n";
            echo "********************************************************************"."\n";		
            echo '**Directorio:'. $rmdir_delete ." ",'eliminado OK'."\n";
            echo "********************************************************************"."\n";	
            echo "\n";
        }
        else{
            echo "\n";
            echo "**********************************************************************"."\n";		
            echo '**ERROR no se puedo eliminar directorio:'. $rmdir_delete ."\n";
            echo "***********************************************************************"."\n";	
            echo "\n";      
        }   
    }
    else{
        echo "\n";
        echo "**********************************************************"."\n";		
        echo '**El Directorio no existe'."\n";
        echo "**********************************************************"."\n";	
        
    }

    

    
    //----------------------------------------------------------------------------------------------------------------------------------
    // Eliminamos linea archivo /etc/hosts mediante script remove_hosts.sh  ej-> /opt/provisioning/remove_hosts.sh <string>
    // $path_script_removehosts = "/opt/provisioning/remove_hosts.sh";
    //------------------------------------------------------------------------------------------------------------------------------------
    $comandohosts= $path_script_removehosts." ".$strDominio;
    echo "\n";
    echo "********************************************************************************"."\n";		
    echo '**Eliminando Vhosts en /etc/hosts ...'."\n";
    echo '**ejecutando script remove_hosts.sh...'."\n";
    echo "********************************************************************************"."\n";	
    echo "\n";
    

    $permisos_removehosts= "chmod +x /opt/provisioning/remove_hosts.sh";
    //echo "estableciendo permisos de ejecucion:chmod +x /opt/provisioning/remove_hosts.sh";
    exec($permisos_removehosts);

    //chmod($path_script_removehosts, 0777);
    //chmod($path_script_removehosts, 0111);

    //exec($comandohosts);
    exec("/opt/provisioning/remove_hosts.sh $strDominio",$output5, $return_var5);

    if($return_var5 !== 0){ // Si exec OK-->$return_var5=0. 

        echo "\n";
        echo "*****************************************************************************"."\n";
        echo 'ERROR al ejecutar el script remove_hosts.sh'.' '.$strDominio."\n";
        echo "*****************************************************************************"."\n";
        echo "\n";
    }
    else{
        echo "\n";
        echo "****************************************************************************"."\n";
        echo '**Se ejecuto correctamente el script remove_hosts.sh'.' '.$strDominio."\n";
        echo '**Registros eliminados correctamente'."\n";
        echo "****************************************************************************"."\n";
        echo "\n";
    }
    

    //----------------------------------------------------------------------------------------------------------------------------------
    // eliminamos linea archivo /etc/extrahosts.d/hosts.d mediante script remove_hosts.sh  ej-> /opt/provisioning/remove_hosts.sh  fran.io
    // $path_script_removehostsd="/opt/provisioning/remove_hostsd.sh";
    //----------------------------------------------------------------------------------------------------------------------------------

    //$comandohostsd=$path_script_removehosts." ".$strDominio;

    //VAMOS POR AQUI
    echo "\n";
    echo "****************************************************************************************"."\n";		
    echo '**Eliminando VHosts en /etc/extrahosts.d/hosts.d...'."\n";
    echo '**ejecutando script remove_hostsd.sh...'."\n";
    echo "****************************************************************************************"."\n";	
    echo "\n";

    //chmod($path_script_removehostsd, 0111);
    $permisos_removehostsd= "chmod +x /opt/provisioning/remove_hostsd.sh";
    //echo "chmod +x /opt/provisioning/remove_hostsd.sh";
    exec($permisos_removehostsd);

    exec("/opt/provisioning/remove_hostsd.sh $strDominio",$output4, $return_var4);

					
        if($return_var4 !== 0){ // Si exec OK-->$return_var4=0. 

            echo "***********************************************************************************"."\n";
            echo 'ERROR al ejecutar el script remove_hostsd.sh para el Vhost::'.$strDominio."\n";
            echo "************************************************************************************"."\n";
            echo "\n";
        }
        else{
            echo "**************************************************************************************"."\n";
            echo '**Se ejecuto correctamente el script para Vhost:'.$strDominio."\n";
            echo '**Registros eliminados correctamente'."\n";
            echo "**************************************************************************************"."\n";
            echo "\n";
        }
            
    
}



?>