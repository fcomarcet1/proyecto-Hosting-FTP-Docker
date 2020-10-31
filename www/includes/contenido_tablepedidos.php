<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-black-800">LISTA DE PEDIDOS</h1>
    <a href="logout.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cerrar Sesion</a>
  </div>
  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12 mx-auto">
      <div class="page-header clearfix">
      <?php if($_SESSION['nivel'] == $usuarioadmin){ ?>
        <a href="pedidos_add.php" class="btn btn-success pull-right">Nuevo Pedido</a>
      <?php } ?>
      </div>
      <?php
      $resultado = mysqli_query($conexionpedidos, "SELECT * FROM tblpedidos p 
                                                  INNER JOIN tblclientes c
                                                ON p.idcliente=c.idCliente"); ?>
      <?php
      if (mysqli_num_rows($resultado) > 0) {
      ?>
        <table class='table table-hover '>
        <thead class="thead-dark">
          <tr>
            <th scope="col">Id Pedido</th>
            <th scope="col">Id Cliente</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Dni Cliente</th>
            <th scope="col">Fecha</th>
            <th scope="col">Peso</th>
            <th scope="col">Alto</th>
            <th scope="col">Ancho</th>
            <?php if($_SESSION['nivel'] == $usuarioadmin){ ?>
            <th scope="col">Acciones</th>
            <?php 
            } 
            ?>
          </tr>
        </thead>
          <?php
          $i = 0;
          while($row = mysqli_fetch_array($resultado)) {
            //Recupera una fila de resultados como un array asociativo, un array numérico  y lo almacena en $resultado
          ?>
            <tr>
              <td><?php echo $row["idPedido"]; ?></td>
              <td><?php echo $row["idcliente"]; ?></td>
              <td><?php echo $row["strNombre"]; ?></td>
              <td><?php echo $row["strApellidos"]; ?></td>
              <td><?php echo $row["strDni"]; ?></td>
              <td><?php echo $row["dtmFecha"]; ?></td>
              <td><?php echo $row["strPeso"]; ?></td>
              <td><?php echo $row["strAlto"]; ?></td>
              <td><?php echo $row["strAncho"]; ?></td>
              <td>
              <?php if($_SESSION['nivel'] == $usuarioadmin){?>
                <a href="pedidos_edit.php?idPedido=<?php echo $row["idPedido"]; ?>" title='Editar registro'>
                  <span class='glyphicon glyphicon-pencil'></span></a>
                <a href="pedidos_delete.php?idPedido=<?php echo $row["idPedido"]; ?>" class="material-icons" onclick="return Confirmation()"><span class="glyphicon glyphicon-trash"></span></a>
              <?php } ?>
              </td>
            </tr>
          <?php
            $i++;
          }
          ?>
        </table>
      <?php
      } 
      else{
        echo "No existen Pedidos";
      }
      mysqli_free_result($resultado);
      mysqli_close($conexionpedidos);
      ?>

    </div>
  </div>

</div>