<?php

//RUTAS
$pathftp = "/srv/ftpusers";
$shell = "/bin/false";
 
//***************************************************
//**************FUNCION ALTA FTP***************** */
//***************************************************

function dar_alta_ftp($strDominio){

    global $pathftp, $shell;

    //-------------------------------------------------
	// crear directorio ftp personal
	//-------------------------------------------------
    
    if(!is_dir($pathftp)){

        echo "**********************************************************"."\n";		
        echo '**Creando directorio :'.' '.$pathftp.'/'.$strDominio."\n";
        echo "**********************************************************"."\n";
        echo "\n";
        mkdir($pathftp."/".$strDominio);


        //-------------------------------------------------
        // Permisos directorio FTP
        // $pathftp = "/srv/ftpusers";
        //-------------------------------------------------

        echo "***********************************************************************************"."\n";		
        echo '**Modificando permisos en el directorio:' . ' ' . $pathftp .'/'. $strDominio ."\n";
        echo "***********************************************************************************"."\n";
        echo "\n";

        //chmod($pathftp."/".$strDominio, 0755);
        //chmod($pathftp."/".$strDominio, 0777);
        echo $pathftp."/".$strDominio."\n";

        chmod($pathftp."/".$strDominio, 0750);


    }
    else{

        echo "***************************************************************************************************"."\n";
        echo '**El directorio:'.' '. $pathftp.'/'.$strDominio.' '."\n";
        echo '**ya existe, este se creo al dar de alta tu vHosts:'.$strDominio."\n";
        echo "***************************************************************************************************"."\n";
        echo "\n";

        echo "***********************************************************************************"."\n";		
        echo '**Modificando permisos en el directorio:' . ' ' . $pathftp .'/'. $strDominio ."\n";
        echo "***********************************************************************************"."\n";
        echo "\n";

        //chmod($pathftp."/".$strDominio, 0755);
        //chmod($pathftp."/".$strDominio, 0777);
        //chmod($pathftp."/".$strDominio, 0755);		
        chmod($pathftp."/".$strDominio, 0750);
    }

 
}

//***************************************************
//**************FUNCION BAJA FTP***************** */
//***************************************************

function dar_baja_ftp($strDominio){

    global $pathftp, $shell;

    //eliminamos directorio de /srv/ftpusers NO ELIMINAR YA QUE PUEDE EXISTIR VHOSTS 
    //rmdir($pathftp."/".$strDominio);


    //-------------------------------------------------
    //eliminar ftpd.passwd (SOLOLECTURA)
    //-------------------------------------------------

    //borrar el usuario charles:
    //raul@ns1:~$ sudo ftpasswd --passwd --name=charles --delete-user

    

}
    
?>