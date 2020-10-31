<?php 

/*if (!isset($_SESSION)) {
  session_start();
}*/
?>

<?php
/*$hostname_conexiondocker = "localhost";  //the name of the mysql service inside the docker file.*/
/*CONTENEDOR  $hostname_conexiondocker = "mysql"; //the name of the mysql service inside the docker file.*/
/*$database_conexiondocker = "docker";*/
/* CONTENEDOR $username_conexiondocker = "user"; */
/*$username_conexiondocker = "root";*/
/* CONTENEDOR $password_conexiondocker = "test"; */
/*$password_conexiondocker = "";*/


$host = 'mysql';  //the name of the mysql service inside the docker file.
$user = 'fran';
$password = 'fran';
$db = 'docker';
$puerto = 3306 ;

$conexiondocker = mysqli_connect($host, $user, $password, $db, $puerto) 
or die ('Error connecting to mysql');
?>

<?php
/*if (is_file("includes/funciones.php")){
	include("includes/funciones.php");
}
else{
	include("../includes/funciones.php");
}
*/
?>