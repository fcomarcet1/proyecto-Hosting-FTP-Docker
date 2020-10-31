<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de Administracion</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <h1>Añadir Nuevo Cliente</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="" maxlength="100" required="">
        </div>
        <div class="form-group ">
            <label>Apellidos</label>
            <input type="text" name="apellidos" class="form-control" value="" maxlength="50" required="">
        </div>
        <div class="form-group">
            <label>Dni</label>
            <input type="text" name="dni" class="form-control" value="" maxlength="75" required="">
        </div>
        <div class="form-group">
            <label>Direccion</label>
            <input type="text" name="direccion" class="form-control" value="" maxlength="75" required="">
        </div>
        <div class="form-group">
            <label>Localidad</label>
            <input type="text" name="localidad" class="form-control" value="" maxlength="50" required="">
        </div>
        <div class="form-group">
            <label>Provincia</label>
            <select class="custom-select mr-sm-2" name="provincia">
                <option value="provincia" selected>Selecciona Provincia</option>
                <?php
                while ($row = mysqli_fetch_array($query)) {
                  echo "<option value=" . $row['idProvincia'] . ">" . $row['idProvincia'] . '  ' . $row['strNombreProvincia'] .  "</option>";
                }
                ?>
              </select>
        </div>
        <div class="form-group">
            <label>CP</label>
            <input type="text" name="cp" class="form-control" value="" maxlength="35" required="">
        </div>

        <input type="submit" class="btn btn-primary" name="enviar" value="Aceptar">
        <a href="index.php" class="btn btn-default">Cancelar</a>
    </form>
</div>