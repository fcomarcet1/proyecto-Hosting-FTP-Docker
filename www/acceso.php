<?php
ob_start();
?>

<?php include_once("conexiones/conexiondocker.php"); ?>

<?php session_start();
/*

if (isset($_SESSION["usuario"])) {

     //+++++++++++++++++++MODIFICAR HEADER+++++++++++++++++++++++++++
     header("location:inicio.php");
     exit();
}

*/
//REGISTRO
if (isset($_POST["registro"])) {
     if (empty($_POST["usuario"]) || empty($_POST["passwd"]) || empty($_POST["passwdrepeat"])) {
          echo '<script>alert("Rellene los campos")</script>';
     } else {

          if (($_POST["passwd"]) == ($_POST["passwdrepeat"])) {
               $usuariorepeat = mysqli_real_escape_string($conexiondocker, $_POST["usuario"]);
               $sqlbuscarusuario = "SELECT * FROM tblusuarios
                                   WHERE strNombre ='" . $usuariorepeat . "'";

               $resultadobuscar = mysqli_query($conexiondocker, $sqlbuscarusuario);
               $countrow = mysqli_num_rows($resultadobuscar);

               if ($countrow == 1){
                    echo "<script>
                              alert('Este usuario ya esta registrado en el sistema. Por favor escoga otro Nombre')
                         </script>";
               }
               else{
                    $usuario = mysqli_real_escape_string($conexiondocker, $_POST["usuario"]);
                    $password = mysqli_real_escape_string($conexiondocker, $_POST["passwd"]);
                    $passwdhash = password_hash($password, PASSWORD_DEFAULT);

                    //MODIFICAR SI QUERMOS HASH values  $passwdhash
                    $sqlinsert = "INSERT INTO tblusuarios (strNombre, strPasswd)
                    VALUES('$usuario', '$passwdhash')";

                    if (mysqli_query($conexiondocker, $sqlinsert)){

                         echo '<script>alert("Registro correcto")</script>';
                    }
                }
          }
          else{
               echo '<script>alert("Las contraseñas no coinciden")</script>';
          }
     }
}
//LOGIN
if (isset($_POST["login"])) {

     if (empty($_POST["usuario"]) || empty($_POST["passwd"])) {

          echo '<script>alert("Rellene los campos")</script>';
     }
     else {

          $usuario = mysqli_real_escape_string($conexiondocker, $_POST["usuario"]);
          $password = mysqli_real_escape_string($conexiondocker, $_POST["passwd"]);
          $sqlselect = "SELECT * FROM tblusuarios WHERE strNombre = '$usuario'";
          $resultado = mysqli_query($conexiondocker, $sqlselect);

          if (mysqli_num_rows($resultado) > 0){
               while ($row = mysqli_fetch_array($resultado)) {

                    //PREGUNTAR SI INTERESA CON HASH O SIN 
                    //if($row["passwd"] == $password)
                    //if (password_verify($password, $row["strPasswd"])) 
                    //echo "$password";
                    //print_r ($row);

                    if (password_verify($password, $row["strPasswd"])){

                         $_SESSION["usuario"] = $usuario;
                         $_SESSION['nivel']  = $row["strNivel"];
                         $_SESSION['instante'] = time();
                         $tipoususario = $row["strNivel"];
                         mysqli_free_result($resultado);

                         header("location:inicio.php");
                    }
                    else {
                         echo '<script>alert("Datos de acceso incorrectos")</script>';
                    }
               }
            }
            else {
               echo '<script>alert("Datos de registro erroneos")</script>';
            }
     }
     mysqli_close($conexiondocker);
}
?>
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">
     <title>Login</title>
</head>

<body>
     <body class="bg-gradient-primary">
          <div class="container">
               <!-- Outer Row -->
               <div class="row justify-content-center">
                    <div class="col-xl-10 col-lg-12 col-md-9">
                         <div class="card o-hidden border-0 shadow-lg my-5">
                              <div class="card-body p-0">
                                   <!-- Nested Row within Card Body -->
                                   <div class="row">
                                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                        <div class="col-lg-6">
                                             <div class="p-5">
                                                  <div class="text-center">
                                                       <h1 class="h4 text-gray-900 mb-4">BIENVENIDO A HOSTING DOCKER</h1>
                                                  </div>
                                                  <?php
                                                  if (isset($_GET["action"]) == "login") {
                                                  ?>

                                                       <h3 align="center">Login</h3>
                                                       <br />
                                                       <form class="user" action="" method="POST">
                                                            <div class="form-group">
                                                                 <input type="text" name="usuario" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Introduce tu nombre de usuario..." required />
                                                            </div>
                                                            <div class="form-group">
                                                                 <input type="password" name="passwd" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Introduce tu contraseña usuario..." required />
                                                            </div>
                                                            <div class="form-group">

                                                            </div>
                                                            <input type="submit" name="login" value="Login" class="btn btn-primary btn-user btn-block" />
                                                       </form>
                                                       <div class="text-center">
                                                            <p><a class="small" href="acceso.php">Registro</a>
                                                            <?php
                                                       }
                                                       else {
                                                            ?>
                                                            </p>
                                                            <p><br />
                                                            </p>
                                                            <h3 align="center">Registro</h3>
                                                            <br />
                                                            <form class="user" action="" method="POST">
                                                                 <div class="form-group">
                                                                      <input type="text" name="usuario" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Introduce tu nombre para registrarte..." required />
                                                                 </div>
                                                                 <div class="form-group">
                                                                      <input type="password" name="passwd" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Introduce tu contraseña para registrarte..." required />
                                                                 </div>
                                                                 <div class="form-group">
                                                                      <input type="password" name="passwdrepeat" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Introduce de nuevo tu contraseña..." required />
                                                                 </div>
                                                                 <input type="submit" name="registro" value="Registrarse" class="btn btn-primary btn-user btn-block" />
                                                                 <br />
                                                                 <p align="center"><a href="acceso.php?action=login">Login</a></p>
                                                            </form>
                                                       <?php
                                                       }
                                                       ?>
                                                       </div>

                                                       <!-- Bootstrap core JavaScript-->
                                                       <script src="vendor/jquery/jquery.min.js"></script>
                                                       <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                                                       <!-- Core plugin JavaScript-->
                                                       <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                                                       <!-- Custom scripts for all pages-->
                                                       <script src="js/sb-admin-2.min.js"></script>


     </body>

</html>
<?php
ob_end_flush();
?>
