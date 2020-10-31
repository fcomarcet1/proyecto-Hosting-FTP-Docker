<?php

//include_once("conexiones/conexiondocker.php");
include_once("lib/funciones_ftp.php");

$host = 'mysql';  //nombre del servicio mysql dentro del docker-compose.
$user = 'fran';
$password = 'fran';
$db = 'docker';
$puerto = 3306 ;

//Conectar BBDD
$conexiondocker = mysqli_connect($host, $user, $password, $db, $puerto) or die ('Error connecting to mysql');

//VARIABLES
$activo = true;
$segundos = 5.33;
$estadoinicial = "0"; //estado antes de efectuar ninguna accion
$estadofinal = "1"; // estado despues de efectuar la accion
$altaftp = "ALTAFTP";
$bajaftp = "BAJAFTP";
$ftpgroup="ftpd";

//RUTAS
$pathftp = "/srv/ftpusers";
$shell = "/bin/false";
$pathpasswd = "/etc/proftpd/ftpd.passwd";

//IPS
$ip="172.20.0.10";
$ip_ftp="172.20.0.9";

$timenow = time();
$fecha = date('m/d/Y');

echo "\n";
echo "********************************************************************"."\n";		
echo '** Bienvenido Daemon Hosting Docker provisioning FTP'." ".$fecha. "\n";
echo '************* Francisco Marcet Prieto 2020 *************************'."\n";
echo "********************************************************************"."\n";		
echo "\n";

	while($activo){

		//echo "dentro 1º while"."\n";
        $sqlftp = mysqli_query($conexiondocker, "SELECT * FROM tblprovisioning WHERE strEstado ='" .$estadoinicial . "' ORDER BY dtmFechaReg ");
		$numrows = mysqli_num_rows($sqlftp);
		
		//echo "nºfilas = $numrows"."\n";

		while($row= mysqli_fetch_array($sqlftp)){

			//echo "dentro 2º while"."\n";

			$idftp = $row["idProvisioning"];
			$passwd = $row["strDatosPassFtp"];
			$ftpuser = $row["strDatosUserFtp"];
			$accion = $row["strAccion"];
			$uid = $row["idProvisioning"] + 2000;	//uid = idProvisioning+2000
			$gid = $row["idProvisioning"] + 2000;	//gui = idProvisioning+2000
			$strDominio = $row["strDatosHost"]; 
				
                if ($accion == $altaftp) {


					echo "**********************************************************"."\n";		
					echo "**Iniciando Alta del Usuario FTP:'.$ftpuser \n";
					echo "**********************************************************"."\n";		
					echo "\n";

					//-------------------------------------------------
					// Llamada a la funcion dar_alta_ftp()
					//-------------------------------------------------

					echo"Values:  $idftp|$ftpuser|$uid|$accion|$strDominio \n ";
					echo "\n"; 	

					echo "**********************************************************"."\n";		
					echo "**Ejecutando funcion dar_alta_ftp() ... \n";
					echo "**********************************************************"."\n";		
					echo "\n";

					chmod($pathftp, 0755);

					dar_alta_ftp($strDominio);
					
					echo "**********************************************************"."\n";		
					echo "**Funcion dar_alta_ftp() ejecutada con exito \n";
					echo "**********************************************************"."\n";		
					echo "\n";


					//-------------------------------------------------
					// creacion usuarios en /srv/ftpusers,
					//-------------------------------------------------		

					echo "***********************************************************************"."\n";		
					echo '**Dando de alta al usuario:'.$ftpuser.'con UID:'.$uid ."\n";
					echo '**Dir home:'.$pathftp.'/'.$strDominio."\n";
					echo "***********************************************************************"."\n";		
					echo "\n";

					//$pathpasswd = "/etc/proftpd/ftpd.passwd";					
					//chmod($pathpasswd, 0660);

					/*
					***Add users to ftpd.passwd
					usuario=usuarioftp2
					grupo=ftpd

					mkdir usuarioftp2.es 
					/usr/sbin/ftpasswd --passwd --uid=7855 --gid=7855 --file=/etc/proftpd/ftpd.passwd --name=usuarioftp2 --home=/srv/ftpusers/usuarioftp2.es --shell=/bin/false

					***Añadir miembros al grupo
						/usr/sbin/ftpasswd --group --gid=7855 --file=/etc/proftpd/ftpd.group --name=ftpd  --member=usuarioftp2 

					**** permisos  directorio
						chown -R 7855:7855 /srv/ftpusers/usuarioftp2.es
						chmod 777 /srv/ftpusers/usuarioftp2.es

					**Eliminar usuarios
						/usr/sbin/ftpasswd --passwd --file=/etc/proftpd/ftpd.passwd --name=usuarioftp2 --delete-user
					
					*/ 


					$comandouserftp='echo '. $passwd.'| /usr/sbin/ftpasswd --passwd --file=/etc/proftpd/ftpd.passwd --name='.$ftpuser.' --uid='.$uid.' --gid='.$gid. ' --home='.$pathftp.'/'.$strDominio.' --shell='.$shell.' --stdin' ;
					//echo "$comandouserftp"."\n";
					exec($comandouserftp);

					exec($comandouserftp,$output8, $return_var8);

					if($return_var8 !== 0){ // Si exec OK-->$return_var8=0. 

						echo "\n";
						echo "*****************************************************************************"."\n";
						echo '**ERROR al Añadir usuario FTP:'.$ftpuser."\n";
						echo "**No se pudo ejecutar el comando ftpasswd Linea()";
						echo "*****************************************************************************"."\n";
						echo "\n";
					}
					else{

						echo "*******************************************************************************"."\n";		
						echo '**Se añadio Usuario:'.$ftpuser.'con UID:'.$uid .' correctamente '."\n";
						echo "*******************************************************************************"."\n";		
						echo "\n";
						}

					



					//---------------------------------------------------------------------------------------------------------
					// AÑADIMOS USUARIO AL GRUPO ftpd
					//  /usr/sbin/ftpasswd --group --gid=7855 --file=/etc/proftpd/ftpd.group --name=ftpd  --member=usuarioftp2 
					//---------------------------------------------------------------------------------------------------------		
					

					echo "****************************************************************************"."\n";		
					echo '**Añadiendo Usuario:'.$ftpuser.'con UID:'.$uid .'al grupo ftpd...'."\n";
					echo "****************************************************************************"."\n";		
					echo "\n";

					$comandogrupoftp='/usr/sbin/ftpasswd --group --gid='.$gid.' --file=/etc/proftpd/ftpd.group --name='.$ftpgroup.' --member='.$ftpuser;
					//echo "$comandogrupoftp"."\n";


					//exec($comandogrupoftp);

					exec($comandogrupoftp,$output7, $return_var7);

					if($return_var7 !== 0){ // Si exec OK-->$return_var7=0. 

						echo "\n";
						echo "*****************************************************************************"."\n";
						echo 'ERROR al Añadir usuario FTP:'.$ftpuser.'al grupo:'.$ftpgroup."\n";
						echo "*****************************************************************************"."\n";
						echo "\n";
					}
					else{

						echo "*******************************************************************************"."\n";		
						echo '**Se añadio Usuario:'.$ftpuser.'con UID:'.$uid .' al grupo ftpd correctamente '."\n";
						echo "*******************************************************************************"."\n";		
						echo "\n";
						}

					

					//-------------------------------------------------
					// AÑADIMOS PERMISOS de propietario
					//chown -R 7855:7855 /srv/ftpusers/usuarioftp2.es
					//-------------------------------------------------		
					
					echo "***********************************************************************************"."\n";		
					echo '**Modificando permisos chown:' . ' ' . $pathftp .'/'. $strDominio ."\n";
					echo "***********************************************************************************"."\n";
					echo "\n";


					$permisosown='chown -R'.' '.$uid.':'.$gid.' /srv/ftpusers/'.$strDominio;
					//echo "$permisosown"."\n";
					exec($permisosown,$output6, $return_var6);

					if($return_var6 !== 0){ // Si exec OK-->$return_var6=0. 

						echo "\n";
						echo "*****************************************************************************"."\n";
						echo 'ERROR al ejecutar permisos chown en:'.'/srv/ftpusers/ '.$strDominio."\n";
						echo "*****************************************************************************"."\n";
						echo "\n";
					}
					else{
						echo "\n";
						echo "****************************************************************************"."\n";
						echo '**Se modificaron correctamente los permisos chown para:'.' /srv/ftpusers/'.$strDominio."\n";
						echo '**Registros eliminados correctamente'."\n";
						echo "****************************************************************************"."\n";
						echo "\n";
					}
					
					

					echo "****************************************************************************"."\n";		
					echo '**Se completo el Alta para el Usuario:'.$ftpuser.'con UID:'.$uid ."\n";
					echo "****************************************************************************"."\n";		
					echo "\n";

					
					
					
					//-------------------------------------------------
					// update tabla provisionin estado = 1
					//-------------------------------------------------

					$updateftpalta = "UPDATE tblprovisioning SET  strEstado='" . $estadofinal . "' WHERE idProvisioning=" . $idftp . "";

					//$sqlupdate = "UPDATE tblprovisioning SET  strEstado='" . $estadofinal . "' WHERE idProvisioning=" . $idftp . "";
					//$resultadoupdate = mysqli_query($conexiondocker, $sqlupdate);			  
					
					if (mysqli_query($conexiondocker, $updateftpalta)){


						echo "\n";
						echo "********************************************************************************************************"."\n";	
						echo '**Tabla provisioning actualizada correctamente para el Usuario Ftp:'.$ftpuser.' '.'con IDPROVISIONING:'.$idftp."\n";
						echo '**Tipo de Accion:'.$accion."\n";
						echo "********************************************************************************************************"."\n";
						echo "\n";
						
					} 
					else{
						echo "\n";
						echo "***************************************************************************************************"."\n";	
						echo "**Error al actualizar registro en tabla provisioning: " . mysqli_error($conexiondocker);
						echo "***************************************************************************************************"."\n";
						echo "\n";
						
					}	
				}
				elseif($accion == $bajaftp) {

					//-------------------------------------------------
					// Llamada a la funcion dar_baja_ftp()
					//-------------------------------------------------

					echo "**********************************************************"."\n";		
					echo "**Ejecutando funcion dar_baja_ftp() ... \n";
					echo "**********************************************************"."\n";		
					echo "\n";

					dar_baja_ftp($strDominio);


					$cmdbajaftp = '/usr/sbin/ftpasswd'.' '.' --passwd --file=/etc/proftpd/ftpd.passwd --name='.$ftpuser.' --delete-user';
					//echo $cmdbaja."\n";
					//exec($cmdbajaftp);
					
					exec($cmdbajaftp,$output9, $return_var9);

					if($return_var9 !== 0){ // Si exec OK-->$return_var8=0. 

						echo "\n";
						echo "*****************************************************************************"."\n";
						echo '**ERROR no se pudo dar de Baja al usuario FTP:'.$ftpuser."\n";
						echo "*****************************************************************************"."\n";
						echo "\n";
					}
					else{

						echo "*******************************************************************************"."\n";		
						echo '**Baja efectuada con exito del Usuario FTP:'.$ftpuser.'con UID:'.$uid ."\n";
						echo "*******************************************************************************"."\n";		
						echo "\n";
						}


					echo "**********************************************************"."\n";		
					echo "**Funcion dar_baja_ftp() ejecutada con exito \n";
					echo "**********************************************************"."\n";		
					echo "\n";

					//-------------------------------------------------
					// update tabla provisionin estado = 1
					//-------------------------------------------------

					$updateftpbaja = "UPDATE tblprovisioning SET  strEstado='" . $estadofinal . "' WHERE idProvisioning=" . $idftp . "";
					//$sqlupdate = "UPDATE tblprovisioning SET  strEstado='" . $estadofinal . "' WHERE idProvisioning=" . $idftp . "";
					//$resultadoupdate = mysqli_query($conexiondocker, $sqlupdate);			  
					
					if (mysqli_query($conexiondocker, $updateftpbaja)){


						echo "\n";
						echo "********************************************************************************************************"."\n";	
						echo '**Tabla provisioning actualizada correctamente para el Usuario Ftp:'.$ftpuser.' '.'con IDPROVISIONING:'.$idftp."\n";
						echo '**Tipo de Accion:'.$accion."\n";
						echo "********************************************************************************************************"."\n";
						echo "\n";
						
					} 
					else{
						echo "\n";
						echo "***************************************************************************************************"."\n";	
						echo "**Error al actualizar registro en tabla provisioning: " . mysqli_error($conexiondocker);
						echo "***************************************************************************************************"."\n";
						echo "\n";
						
					}	

				}

					
		
		}

		mysqli_free_result($sqlftp);
		echo "Esperando usuario FTP"."\n";
		//echo 'Esperando nuevo Usuarios FTP|'."";
		sleep($segundos);
		
	}

	//mysqli_close($conexiondocker);


?>