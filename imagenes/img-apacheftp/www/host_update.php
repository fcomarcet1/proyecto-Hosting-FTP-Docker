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

/*if(($_SESSION["nivel"])!= $usuarioadmin){

  session_destroy();
  header("location:acceso.php?action=login");
  exit();
}
*/

$timenow = time();
if((($timenow - $_SESSION["instante"])>$timexpired)){

      session_destroy();
      header ("Location:acceso.php?action=login");
      exit();
}
$_SESSION["instante"]=$timenow;
?>

<?php
//*******************MODIFICAR*****************************
//*******************MODIFICAR*****************************
if (ISSET($_POST["actualizar"])) {


  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $dni = $_POST['dni'];
  $direccion = $_POST['direccion'];
  $localidad = $_POST['localidad'];
  $provincia = $_POST['idprovinciaHdd'];
  //echo "$provincia";
  $cp = $_POST['cp'];

//*******************MODIFICAR*****************************
//*******************MODIFICAR*****************************
  $sqlupdate = "UPDATE tblclientes
                 SET  strNombre='" . $_POST['nombre'] . "',
                      strApellidos='" . $_POST['apellidos'] . "',
                      strDni='" . $_POST['dni'] . "' ,
                      strDireccion='" . $_POST['direccion'] . "' ,
                      strLocalidad='" . $_POST['localidad'] . "' ,
                      intProvincia='" . $_POST['provincia'] . "',
                      strCp='" . $_POST['cp'] . "'
                WHERE idCliente=" . $_POST['idClienteHdd'] . "";

//echo "$sqlupdate";
//exit();
  $resultadoupdate = mysqli_query($conexiondocker, $sqlupdate);

  if ($resultadoupdate) {
    header("location: clientes_lista.php");
    exit();
  }
  else {
    $error = true;
    $error_msg = "Error: " . $sqlupdate . " " . mysqli_error($conexiondocker);
  }
}

?>

<?php mysqli_close($conexiondocker); ?>


<!DOCTYPE html>
<html lang="es">
<!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
  <?php include_once("includes/meta.php"); ?>
  <?php include_once("includes/head.php"); ?>


  <!-- InstanceBeginEditable name="doctitle" -->
  <title>Dashboard Gestion Pedidos</title>
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
          <!-- Content Row -->
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
  <?php include_once("includes/logoutmodal.php"); ?>
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