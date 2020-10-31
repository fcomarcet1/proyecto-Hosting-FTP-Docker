<?php 
require_once 'connections/conexionpedidos.php';

//****************************************************
//*************************************************** 

function conexionpedidos(){

    global $hostname_conexionpedidos,$database_conexionpedidos,
           $username_conexionpedidos, $password_conexionpedidos; 
    global $conexionpedidos ;
    
    $conexionpedidos = mysqli_connect($hostname_conexionpedidos, $username_conexionpedidos, 
                                  $password_conexionpedidos, $database_conexionpedidos ) 
                                  or die ('Error connecting to mysql');

}

//***************************************************
//***************************************************

function desconexionpedidos(){

    global $conexionpedidos ;
    mysqli_close($conexionpedidos);
}    

//***************************************************
//***************************************************







?>