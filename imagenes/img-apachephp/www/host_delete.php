<?php
ob_start();
?>
<?php include_once("conexiones/conexiondocker.php"); ?>

<?php
session_start();

if(!isset($_SESSION["usuario"])){

     header("location:acceso.php?action=login");
}

/*if(($_SESSION["nivel"])!== $usuarioadmin){

  session_destroy();
  header("location:acceso.php?action=login");
  exit;
}
*/
$timenow = time();
if((($timenow- $_SESSION["instante"])>$timexpired)){

      session_destroy();
      header ("Location:acceso.php?action=login");
      exit;

}
$_SESSION["instante"]=$timenow;
?>

<?php
if (isset($_REQUEST["idHost"])) {

  $idhost = $_REQUEST["idHost"];
  $accion = "BAJAHOST";
  $estado = "0";

  // select para obtener valores a insertar en tblprovisioning antes de eliminar el host
  $sqlselect = "SELECT * FROM tblhosts WHERE idHost='" .  $idhost . "' ";
  $resultado = mysqli_query($conexiondocker,$sqlselect);
  $row = mysqli_fetch_array($resultado,MYSQLI_ASSOC);

    $usuario = $row["strUsuario"];
    $dominio = $row["srtDominio"];


  $sqlinsert = "INSERT INTO tblprovisioning (strUsuario,strAccion,strDatosHost,strEstado)
                VALUES ('$usuario','$accion','$dominio','$estado')";
  $query = mysqli_query($conexiondocker, $sqlinsert);

  //una vez insertados en tblprovisioning ya podemos borrar host
  $sqldelete = "DELETE FROM tblhosts WHERE idHost='" .  $idhost . "'";

  if (mysqli_query($conexiondocker, $sqldelete)) {
    header("location:host_lista.php");
    exit();
  }

  else {
    echo "Error al eliminar el Host: " . mysqli_error($conexiondocker);
  }

  mysqli_free_result($resultado);
  mysqli_close($conexiondocker);
}
/*else {
    printf("El parametro no llega");
}
*/
?>

<!DOCTYPE html>
<html lang="es">
<!-- InstanceBegin template="/Templates/principal.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
  <?php include_once("includes/meta.php"); ?>
  <?php include_once("includes/head.php"); ?>

  <!-- InstanceBeginEditable name="doctitle" -->
  <title>Dashboard Hosting Docker</title>
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