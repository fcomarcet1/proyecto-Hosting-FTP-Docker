<?php 
require_once 'conexiones/conexiondocker.php';

//****************************************************
//*************************************************** 




//***************************************************
//***************************************************

/*function desconexiondocker(){

    global $conexiondocker ;
    mysqli_close($conexiondocker);
} */   

//***************************************************
//***************************************************

/*function ObtenerNombreUsuario($idusuario)
{

	global $database_conexiondocker, $conexiondocker;

	mysqli_select_db($database_conexionpedidos, $conexiondocker);
	$query_ConsultaFuncion = sprintf("SELECT strNombre FROM tblusuario WHERE idUsuario = %s", $idusuario);
	$ConsultaFuncion = mysqli_query($query_ConsultaFuncion, $conexiondocker) or die(mysqli_error());
	$row_ConsultaFuncion = mysqli_fetch_assoc($ConsultaFuncion);
	$totalRows_ConsultaFuncion = mysqli_num_rows($ConsultaFuncion);
	
	return $row_ConsultaFuncion['strNombre']; 
	mysqli_free_result($ConsultaFuncion);
}

*/



?>