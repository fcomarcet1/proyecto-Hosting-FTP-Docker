<?php include_once("includes/conexionpedidos.php"); ?>

<!DOCTYPE html>
<html lang="es">

<head>
<?php include_once("includes/meta.php"); ?>
<?php include_once("includes/head.php"); ?>

 
<!-- TemplateBeginEditable name="doctitle" -->
  <title>Dashboard Gestion Pedidos</title>
  <!-- TemplateEndEditable -->
  <!-- Custom fonts for this template-->
  
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->
</head>

<body id="page-top">
<!-- TemplateBeginEditable name="contenido" -->
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
      <?php include_once("includes/contenido.php"); ?>
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
<!-- TemplateEndEditable -->
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

</html>
