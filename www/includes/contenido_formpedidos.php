<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de Administracion</h1>
        <a href="logout.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cerrar Sesion</a>

    </div>

    <!-- Content Row -->
    <h1>Editar Pedido</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <!-- Lista de seleccion -->
        <div class="form-group">
            <label>Cliente</label>
            <select name="idcliente" required="">
                <!-- Opciones de la lista -->
                <option value="1">Opción 1</option>
                <option value="2" selected>Opción 2</option> <!-- Opción por defecto -->
                <option value="3">Opción 3</option>
            </select>
        </div>
        <div class="form-group ">
            <label>Fecha</label>
            <input type="text" name="fecha" class="form-control" value="" maxlength="50" required="">
        </div>
        <div class="form-group">
            <label>Peso</label>
            <input type="text" name="peso" class="form-control" value="" maxlength="75" required="">
        </div>
        <div class="form-group">
            <label>Alto</label>
            <input type="text" name="alto" class="form-control" value="" maxlength="75" required="">
        </div>
        <div class="form-group">
            <label>Ancho</label>
            <input type="text" name="ancho" class="form-control" value="" maxlength="50" required="">
        </div>

        <input type="submit" class="btn btn-primary" name="enviar" value="Aceptar">
        <a href="pedidos_lista.php" class="btn btn-default">Cancelar</a>
    </form>
</div>