<?php 

/*if (!isset($_SESSION)) {
  session_start();
}*/
?>

<?php
$hostname_conexionpedidos = "localhost";
$database_conexionpedidos = "gestionpedidos";
$username_conexionpedidos = "root";
$password_conexionpedidos = "";
$timexpired = 300;

$usuarioadmin = "administrador";
$usuarioguest = "invitado";

$conexionpedidos = mysqli_connect($hostname_conexionpedidos, $username_conexionpedidos, 
                                  $password_conexionpedidos, $database_conexionpedidos ) 
                                  or die ('Error connecting to mysql');
?>

<?php
if (is_file("includes/funciones.php")){
	include("includes/funciones.php");
}
else{
	include("../includes/funciones.php");
}
?>