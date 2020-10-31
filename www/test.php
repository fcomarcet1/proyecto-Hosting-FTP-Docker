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

$idhost= 34;
$sqlselect2 = "SELECT * FROM tblhosts h
                INNER JOIN tblftpusuarios f
                ON h.idHost=f.idhost
                WHERE h.idHost='" .  $idhost . "' ";

  $resultado2 = mysqli_query($conexiondocker,$sqlselect2);
  //$row2 = mysqli_fetch_array($resultado2,MYSQLI_ASSOC);

  //$i = 0;
  while ($row2 = mysqli_fetch_array($resultado2)) {

    //$usuarioftp = $row2["strUsuarioftp"];
    //$passwdftp = $row2["strDatosPassFtp"];
    echo $row2['strUsuario'];
    echo"--------------------------------------------------------------";
    //echo "$passwdftp";

    //insertar que userftp baja debido a delete host
    /*$sqlinsert2 = "INSERT INTO tblprovisioning
          (strUsuario, strAccion, strDatosHost, strDatosUserFtp, strDatosPassFtp, strEstado)
    VALUES ('$usuarioftp','$accion2','$dominio','$usuarioftp','$passwdftp','$estado')";
    $query = mysqli_query($conexiondocker, $sqlinsert2);*/
    $i++;
  }


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