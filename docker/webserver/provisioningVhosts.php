<?php
//include_once("conexiones/conexiondocker.php");
include_once("lib/funciones_host.php");

$host = 'mysql';  //nombre del servicio mysql dentro del docker-compose.
$user = 'fran';
$password = 'fran';
$db = 'docker';
$puerto = 3306 ;


$path = "/var/www/html";
$activo = true;
$segundos = 4.5;
$estadoinicial = "0"; //estado antes de efectuar ninguna accion 
$estadofinal = "1"; // estado despues de efectuar la accion
$altahost = "ALTAHOST";
$bajahost = "BAJAHOST";

//IPS
$ip="172.20.0.10";
$ip_ftp="172.20.0.9";

//RUTAS
$path_a2ensite="/usr/sbin/a2ensite";
$path_a2dissite="/usr/sbin/a2dissite";
$path_extrahosts= "/etc/extrahosts.d/hosts.d";
$pathhosts = "/etc/hosts";
$www_dom = "www.";
$ftp_dom="ftp.";


//Conectar BBDD
$conexiondocker = mysqli_connect($host, $user, $password, $db, $puerto) or die ('Error connecting to mysql');

$timenow = time();
$fecha = date('m/d/Y');

echo "\n";
echo "********************************************************************"."\n";		
echo '** Bienvenido Daemon Hosting Docker provisioning VHOSTS'." ".$fecha. "\n";
echo '************* Francisco Marcet Prieto 2020 *************************'."\n";
echo "********************************************************************"."\n";		
echo "\n";

	while($activo){
        $resultado = mysqli_query($conexiondocker, "SELECT * FROM tblprovisioning WHERE strEstado ='" .$estadoinicial . "' ORDER BY dtmFechaReg ");
        $numrows = mysqli_num_rows($resultado);
		//echo 'Esta ' . 'cadena ' . 'está ' . 'hecha ' . 'con concatenación.' . "\n";
		//echo "nºfilas = $numrows";
		while($row= mysqli_fetch_array($resultado)){

				$id = $row["idProvisioning"];
                $accion = $row["strAccion"];
                $strDominio = $row["strDatosHost"]; //nombre dominio ej asix.es
				//echo 'dentro while row'."\n";
				//echo "$id|$accion|$srtdominio "; 
				
                if ($accion == $altahost){

					//-------------------------------------------------
					// Llamada a la funcion dar_alta_host()
					//-------------------------------------------------

					echo"Values:  $id|$accion|$strDominio \n ";
					echo "\n"; 

					echo "**********************************************************"."\n";		
					echo "** Ejecutando funcion dar_alta_host() ... \n";
					echo "**********************************************************"."\n";		
					echo "\n";

					dar_alta_host($strDominio);

					echo "**********************************************************"."\n";		
					echo "**Funcion dar_alta_host() ejecutada con exito \n";
					echo "**********************************************************"."\n";		
					echo "\n";

					//-------------------------------------------------
					// Activamos sitio mediante a2ensite misitio.es
					//-------------------------------------------------

					$a2ensite = $path_a2ensite." ".$strDominio;
					echo "**********************************************************"."\n";		
					echo '**Ejecutando a2ensite para:'.$strDominio."\n";
					echo "**********************************************************"."\n";	
					echo "\n";
					exec("/usr/sbin/a2ensite $strDominio",$output, $return_var);

					
					if($return_var !== 0){ // Si exec OK-->$return_var=0. 

						echo "**********************************************************"."\n";
						echo 'ERROR al ejecutar a2ensite para el Vhost::'.$strDominio."\n";
						echo "**********************************************************"."\n";
						echo "\n";
					}
					else{
						echo "*********************************************************************"."\n";
						echo '**Se ejecuto correctamente a2ensite para:el Vhost:'.$strDominio."\n";
						echo "**********************************************************************"."\n";
						echo "\n";
					}
					
					//-------------------------------------------------
					// Reinicio Servidor Apache
					//-------------------------------------------------
					echo "\n";
					echo "**********************************************************"."\n";		
					echo '**Reiniciando Servidor Apache(Webserver)....'."\n";
					echo "**********************************************************"."\n";
					echo "\n";	

					$reload= " /etc/init.d/apache2 reload";
					exec($reload, $output2, $return_var2);

					if($return_var2 !== 0){ // Si exec OK-->$return_var2=0. 
						
						echo "**********************************************************"."\n";
						echo '**ERROR al reiniciar Servidor el Apache(Webserver)'."\n";
						echo "**********************************************************"."\n";
						echo "\n";
					
					}
					else{
						echo "**********************************************************"."\n";
						echo '**Se reinicio correctamente el Servidor Apache(Webserver):'."\n";
						echo "**********************************************************"."\n";
						echo "\n";
					}

					//-------------------------------------------------
					// archivo añadimos host en  /etc/hosts
					// $pathhosts = "/etc/hosts";
					//------------------------------------------------- 
					echo "**********************************************************"."\n";	
					echo '**Añadiendo registro en:'.' '. "$pathhosts" .' '.'...'."\n" ;
					echo "**********************************************************"."\n";
					echo "\n";
					
					echo 'IP:'."$ip"."\n";
					echo 'IP_FTP:'."$ip_ftp"."\n";
					echo 'ruta:'."$pathhosts"."\n";
					echo 'Dominio:'."$strDominio"."\n";
					echo "$www_dom"."\n";
					echo "$ftp_dom"."\n";
					
					
					$myfilehost = fopen($pathhosts, "a+") or die("Unable to open file!"); // usamos +a para que escriba al final del fichero 
			
						$txt3 = $ip ."\t". $strDominio ." "." ". $www_dom .$strDominio."\n" ;//	172.20.0.10   fran.io  www.fram.io
						fwrite($myfilehost, $txt3);

						//echo "1º linea OK"."\n";
						echo 'IP_FTP:'."$ip_ftp"."\n";
						echo 'var ftp_dom:'."$ftp_dom"."\n";
						echo 'Dominio:'."$strDominio"."\n";

						$txt4 =$ip_ftp ."\t".  $ftp_dom .$strDominio. "\n" ;//	172.20.0.9    ftp.fran.io
						fwrite($myfilehost,$txt4);
						//echo "2º LINEA OK"."\n";
						fclose($myfilehost);

						echo "\n";
						echo "**********************************************************"."\n";	
						echo '**Registros añadidos correctamente en:'." "."$pathhosts"."\n";
						echo "**********************************************************"."\n";
						echo "\n";

					
					//-------------------------------------------------
					// copiamos Nuevos Vhosts a /etc/extrahosts.d/hosts.d
					// $path_extrahosts= "/etc/extrahosts.d/hosts.d";
					//-------------------------------------------------		
					echo "*****************************************************************"."\n";	
					echo '**Copiando nuevos Vhosts en:'.' '. "$path_extrahosts" .' '.'...'."\n" ;
					echo "*****************************************************************"."\n";	
					echo "\n";

					echo 'IP:'."$ip"."\n";
					echo 'IP_FTP:'."$ip_ftp"."\n";
					echo 'ruta:'."$path_extrahosts"."\n";
					echo "$www_dom"."\n";
					echo "$ftp_dom"."\n";
					echo "\n";

					$myfileextrahost = fopen($path_extrahosts, "a+") or die("Unable to open file!");
						
						$txth3 = $ip ."\t". $strDominio ." "." ". $www_dom .$strDominio."\n" ;//172.20.0.10   fran.io  www.fram.io
						fwrite($myfileextrahost, $txth3);
						$txth4 =$ip_ftp ."\t".  $ftp_dom .$strDominio. "\n" ;//	172.20.0.9    ftp.fran.io
						fwrite($myfileextrahost,$txth4);
						fclose($myfileextrahost);

					echo "**********************************************************************"."\n";			
					echo '**Vhosts almacenados con exito en:'.' '. "$path_extrahosts" .' '.'...'."\n" ;
					echo "**********************************************************************"."\n";
					echo "\n";

					//update
					//-------------------------------------------------
				// update tabla provisionin estado = 1
				//-------------------------------------------------

				$sqlupdatealta = "UPDATE tblprovisioning SET  strEstado='" . $estadofinal . "' WHERE idProvisioning=" . $id . " ";

				//AND strAccion= "$altahost" OR strAccion ="$bajahost"
				//$resultadoupdate = mysqli_query($conexiondocker, $sqlupdate);	

				if (mysqli_query($conexiondocker, $sqlupdatealta)){
					echo "\n";
					echo "********************************************************************************************************"."\n";	
					echo '**Tabla provisioning actualizada correctamente para el Vhost:'.$strDominio.' '.'con ID PROVISIONING:'.$id."\n";
					echo '**Tipo de Accion:'.$accion."\n";
					echo "********************************************************************************************************"."\n";
					echo "\n";	
				}
				else{
					echo "\n";
					echo "******************************************************************************************************"."\n";	
					echo "**Error al actualizar registro en tabla provisioning: " . mysqli_error($conexiondocker);
					echo "******************************************************************************************************"."\n";
					echo "\n";	
				}			  

				}
				elseif($accion == $bajahost){


					//-------------------------------------------------
					// Desactivamos sitio mediante a2dissite misitio.es
					//-------------------------------------------------

					$a2dissite = $path_a2dissite." ".$strDominio;
					echo "**********************************************************"."\n";		
					echo '**Ejecutando a2dissite para:'.$strDominio."\n";
					echo "**********************************************************"."\n";	
					echo "\n";
					exec("/usr/sbin/a2dissite $strDominio",$output3, $return_var3);

					
					if($return_var3 !== 0){ // Si exec OK-->$return_var=0. 

						echo "**********************************************************************"."\n";
						echo 'ERROR al ejecutar a2dissite para el Vhost::'.$strDominio."\n";
						echo "**********************************************************************"."\n";
						echo "\n";
					}
					else{
						echo "***********************************************************************"."\n";
						echo '**Se ejecuto correctamente a2dissite para:el Vhost:'.$strDominio."\n";
						echo "***********************************************************************"."\n";
						echo "\n";
					}
					
					//-------------------------------------------------
					// Llamada a la funcion dar_baja_host()
					//-------------------------------------------------
					echo "**********************************************************"."\n";
					echo "Ejecutando funcion dar_baja_hosts()..."."\n";
					echo "**********************************************************"."\n";
					echo "\n";

					dar_baja_host($strDominio);

					echo "**********************************************************"."\n";
					echo "Funcion dar_baja_hosts() ejecutada con exito"."\n";
					echo "**********************************************************"."\n";
					echo "\n";


					//-------------------------------------------------
				// update tabla provisionin estado = 1
				//-------------------------------------------------

				$sqlupdatebaja = "UPDATE tblprovisioning SET  strEstado='" . $estadofinal . "' WHERE idProvisioning=" . $id . " ";

				//AND strAccion= "$altahost" OR strAccion ="$bajahost"
				//$resultadoupdate = mysqli_query($conexiondocker, $sqlupdate);	

				if (mysqli_query($conexiondocker, $sqlupdatebaja)){
					echo "\n";
					echo "********************************************************************************************************"."\n";	
					echo '**Tabla provisioning actualizada correctamente para el Vhost:'.$strDominio.' '.'con ID PROVISIONING:'.$id."\n";
					echo '**Tipo de Accion:'.$accion."\n";
					echo "********************************************************************************************************"."\n";
					echo "\n";	
				}
				else{
					echo "\n";
					echo "******************************************************************************************************"."\n";	
					echo "**Error al actualizar registro en tabla provisioning: " . mysqli_error($conexiondocker);
					echo "******************************************************************************************************"."\n";
					echo "\n";	
				}			  	


				}


				
			  
		}

		mysqli_free_result($resultado);
		echo 'Esperando nuevo VHosts ...'."\n";
		//echo 'Esperando nuevo VHosts|'." ";
		sleep($segundos);
	}

	//mysqli_close($conexiondocker);


?>