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
$query = mysqli_query($conexiondocker, "SELECT * FROM tblhosts");
$row = mysqli_fetch_array($query);
?>
<?php

  if(isset($_POST["alta"])){

      $usuariohostid = $_POST["dominio"];
      $usuarioftp = $_POST["usuarioftp"];
      $passwordftp = $_POST["passwordftp"];
      $accion = "ALTAFTP";
      $estado = "0";

      //obtenemos nombre dominio asociado al idHost
      $queryid = mysqli_query($conexiondocker, "SELECT * FROM tblhosts 
                                                WHERE idHost ='" . $_POST['dominio'] . "' ");
      $rowid = mysqli_fetch_array($queryid);

      $usuariohost = $rowid['strUsuario'];
      $dominio = $rowid['srtDominio'];

      $sqlinsert1 = "INSERT INTO tblftpusuarios (idhost, strUsuarioftp, strPasswd)
                      VALUES ('$usuariohostid', '$usuarioftp', '$passwordftp')";
      $query1 = mysqli_query($conexiondocker, $sqlinsert1);

      $sqlinsert2 = "INSERT INTO tblprovisioning
             (strUsuario, strAccion, strDatosHost, strDatosUserFtp, strDatosPassFtp, strEstado)
      VALUES ('$usuariohost', '$accion', '$dominio', '$usuarioftp', '$passwordftp', '$estado')";
      //$query2 = mysqli_query($conexiondocker, $sqlinsert2);

        
        if ((mysqli_query($conexiondocker, $sqlinsert2))) {
          header("location: ftp_lista.php");
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
<h2>Añadir Usuario FTP</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group">
        <label>dominio</label>
        <select class="custom-select mr-sm-2" name="dominio">
              <option value="Hosts" selected>Selecciona tu dominio</option>
                <?php
                while ($row = mysqli_fetch_array($query)) {
                  echo "<option value=" . $row['idHost'] . ">" . $row['strUsuario'] . '  '.'  ' . $row['srtDominio'] .  "</option>";
                }
                ?>
        </select>
    </div>
    <div class="form-group ">
        <label>Usuario</label>
        <input type="text" name="usuarioftp" placeholder="Introduce tu Usuario"
        class="form-control" value="" maxlength="50" required="">
    </div>
    <div class="form-group ">
        <label>Password</label>
        <input type="password" name="passwordftp" placeholder="Introduce tu Contraseña"
        class="form-control" value="" maxlength="50" required="">
    </div>
    <input type="submit" class="btn btn-primary" name="alta" value="Aceptar">
    <a href="inicio.php" class="btn btn-default">Cancelar</a>
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
