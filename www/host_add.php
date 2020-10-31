<?php
ob_start();
?>
<?php include_once("conexiones/conexiondocker.php"); ?>

<?php
session_start();

if(!isset($_SESSION["usuario"])){

     header("location:acceso.php?action=login");
     exit();
}

$timenow = time();
if((($timenow- $_SESSION["instante"])>$timexpired)){

      session_destroy();
      header ("Location:acceso.php?action=login");
      exit();
}

$_SESSION["instante"]=$timenow;

?>

<?php
if(isset($_POST['alta'])){

     $usuario = $_POST['usuario'];
     $password = $_POST['password'];
     $dominio = $_POST['dominio'];
     $email = $_POST['email'];
     $accion = "ALTAHOST";
     $estado = "0";


     $sqlinsert1 = "INSERT INTO tblhosts
     (strUsuario,strPasswd,strEmail,srtDominio)
     VALUES ('$usuario','$password','$email','$dominio')";
     $query1 = mysqli_query($conexiondocker, $sqlinsert1);

     $sqlinsert2 = "INSERT INTO tblprovisioning
     (strUsuario,strAccion,strDatosHost,strEstado)
     VALUES ('$usuario','$accion','$dominio','$estado')";
     //$query2 = mysqli_query($conexiondocker, $sqlinsert2);

      if ((mysqli_query($conexiondocker, $sqlinsert2))) {
        header("location: host_lista.php");
        exit();
      }
	    /*else {
        $error= true;
        $error_msg = "Error: " . $sqlinsert . " " . mysqli_error($conexiondocker);
      }
      */
     mysqli_close($conexiondocker);
}
?>

<!DOCTYPE html>
<html lang="es"><!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->

<head>
<?php include_once("includes/meta.php"); ?>
<?php include_once("includes/head.php"); ?>


<!-- InstanceBeginEditable name="doctitle" -->
  <title>Dashboard HOSTING DOCKER</title>
  <!-- InstanceEndEditable -->
  <!-- Custom fonts for this template-->

<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>

<body id="page-top">
<!-- InstanceBeginEditable name="contenido" -->
<!-- Page Wrapper -->
<div id="wrapper">
  <!-- Sidebar -->
  <?php include_once("includes/menu.php"); ?>
  <!-- End of Sidebar -->
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
      <!-- Topbar -->
      <?php include_once("includes/topbar.php"); ?>
      <!-- End of Topbar -->
      <!-- Begin Page Content -->
      <!-- /.container-fluid -->
      <div class="container-fluid">

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Administracion Hosting Docker</h1>
    <a href="logout.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cerrar Sesion</a>    
</div>


<!-- Content Row-->
<h2>Añadir Nuevo Host</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group">
        <label>Usuario</label>
        <input type="text" name="usuario" placeholder="Introduce tu Nombre de Usuario"
        class="form-control" value="" maxlength="100" required="">
    </div>
    <div class="form-group ">
        <label>Password</label>
        <input type="password" name="password" placeholder="Introduce tu Contraseña"
        class="form-control" value="" maxlength="50" required="">
    </div>
    <div class="form-group">
        <label>Dominio</label>
        <input type="text" name="dominio" placeholder="Introduce tu Dominio" 
        pattern="^([a-zA-Z0-9]([a-zA-Z0-9\-]{0,61}[a-zA-Z0-9])?\.)+[a-zA-Z]{2,6}$"
        title="example.com/fran.es" class="form-control" value="" maxlength="75" required="">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" placeholder="Introduce tu Email" pattern=".+@*.*"
        class="form-control" value="" maxlength="75" required="">
    </div>

    <input type="submit" class="btn btn-primary" name="alta" value="Aceptar">
    <a href="index.php" class="btn btn-default">Cancelar</a>
</form>
</div>
    </div>
    <!-- End of Main Content -->
    <!-- Footer -->
    <?php include_once("includes/pie.php"); ?>
    <!-- End of Footer -->
  </div>
  <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<?php include_once("includes/scrollbuttonup.php"); ?>
<!-- Logout Modal-->

<!-- InstanceEndEditable -->
	<!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

<!-- InstanceEnd -->
</html>
<?php
ob_end_flush();
?>
