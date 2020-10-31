<!-- put in ./www directory -->

<?php include_once("conexiones/conexiondocker.php"); ?>
<?php
mysqli_set_charset($conexiondocker, "utf8");
$query = 'SELECT * From tblusuarios';
$resultado = mysqli_query($conexiondocker, $query);
//$row = mysqli_fetch_array($resultado);
?>

<html>
 <head>
  <title>Hello...</title>

  <meta charset="utf-8"> 

  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>
    <div class="container">

    
    <?php echo "<h1>Hola! Test docker-compose</h1>"; ?>

    <h2>Fecha y Hora actual</h2>

    <?=date('m/d/Y g:ia');?>

    <p>
    
  <?php
  if (mysqli_num_rows($resultado) > 0) {
  ?>
    <table class='table table-hover '>
      
    <thead class="thead-dark">
      <tr>
        
        <th scope="col">Nombre</th>
        
        
      </tr>
      </thead>
      <tbody>
      <?php
      //$i = 0;
      while ($row = mysqli_fetch_array($resultado)) {
        //Recupera una fila de resultados como un array asociativo, un array numérico  y lo almacena en $resultado
      ?>
        <tr>
          
          <td><?php echo $row["strNombre"]; ?></td>
    
        </tr>
      <?php
      $i++;
      }
      mysqli_free_result($resultado);
      ?>
      </tbody>
    </table>
  <?php
  } 
  else {
    echo "No se encontro resultados";
  }
  mysqli_close($conexiondocker);
  ?>
    
    