<div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Lista de Clientes</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i></a>
          </div>

          <!-- Content Row -->
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="page-header clearfix">
                        
                        <a href="clientes_add.php" class="btn btn-success pull-right">Añadir Cliente</a>
                    </div>
                   <?php
                    
                    $resultado = mysqli_query($conexionpedidos,"SELECT * FROM tblclientes");
                    ?>

                    <?php
                    if (mysqli_num_rows($resultado) > 0) {
                    ?>
                      <table class='table table-bordered table-striped'>
                      
                      <tr>
                        <td>Id</td>
                        <td>Dni</td>
                        <td>Nombre</td>
                        <td>Apellidos</td>
                        <td>Direccion</td>
                        <td>Localidad</td>
                        <td>Provincia</td>
                        <td>Codigo Postal</td>
                        <td>Acciones</td>
                      </tr>
                    <?php
                    $i=0;
                    while($row = mysqli_fetch_array($resultado)) { 
                    //Recupera una fila de resultados como un array asociativo, un array numérico  y lo almacena en $resultado
                    ?>
	                    <tr>
	                        <td><?php echo $row["idCliente"]; ?></td>
	                        <td><?php echo $row["strDni"]; ?></td>
	                        <td><?php echo $row["strNombre"]; ?></td>
	                        <td><?php echo $row["strApellidos"]; ?></td>
	                        <td><?php echo $row["strDireccion"]; ?></td>
	                        <td><?php echo $row["strLocalidad"]; ?></td>
	                        <td><?php echo $row["strProvincia"]; ?></td>
	                        <td><?php echo $row["intCp"]; ?></td>
	                        <td><a href="clientes_edit.php?idCliente=<?php echo $row["idCliente"]; ?>" title='Editar registro'>
	                        <span class='glyphicon glyphicon-pencil'></span></a>
	                        <a href="clientes_delete.php?idCliente=<?php echo $row["idCliente"]; ?>" title='borrar'><i class='material-icons'><span class='glyphicon glyphicon-trash'></span></a>
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
                        echo "No se encontro resultado";
                    }
                    mysqli_free_result($resultado);
                    mysqli_close($conexionpedidos);
                    ?>

                </div>
            </div>   
            
        </div>