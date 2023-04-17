<?php 
require('../../config/db.php');

$boton = (!empty($_POST['boton']))?$_POST['boton']:"";
$fecha = (!empty($_POST['fecha']))?$_POST['fecha']:"";

if (isset($fecha)) {
	$sql = $conexion->prepare("SELECT * FROM ganancias_cakeshop WHERE fecha=:fecha");
	$sql->bindParam(":fecha",$fecha);
	$sql->execute();
	$rowC=$sql->fetchAll(PDO::FETCH_ASSOC);
}
if (empty($rowC)) {
	$e="<span style='color:#E20000;'>No se Encontraron Parecidos</span>";	
}


$sql = $conexion->prepare('SELECT * FROM ganancias_cakeshop');
$sql->execute();
$row=$sql->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../../css/specifications.css">
</head>
<body>
	<nav class="navbar nav-bg-color navbar-expand-lg">
  		<div class="container-fluid">
		  <a class="navbar-brand h1" href="../">Bon & Dulce</a>
  		</div>
  		<button class="navbar-toggler nav-toggler-position position-absolute end-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Enlace</a>
        <a class="nav-link active" href="#">Almacen</a>
        <a class="nav-link active" href="cerrar.php">Cerrar Sesion</a>
      </div>
    </div>
	</nav>
	
	<div class="wall-bg-color">
		<div class="container">
		<div class="">
			<br>
				<form method="POST">
					<label>Buscar Fecha</label>
					<input type="date" name="fecha">

					<input type="submit" name="boton">
				</form>
				<br>
				<?php if(isset($e)){echo $e;}
				else{ ?>
				<table border="1" class="table table-striped table-dark table-bordered">
				<tr>
					<th>ID</th>
					<th>CLIENTE</th>
					<th>GANANCIA NETA</th>
					<th>GANANCIA BRUTA</th>
					<th>CANTIDAD</th>
					<th>FECHA</th>
				</tr>
					<?php foreach ($rowC as $keyC) {
					 ?>
				<tr>
					
					<td><?php echo $keyC['id']; ?></td>
					<th><?php echo $keyC['cliente']; ?></th>
					<td><?php echo $keyC['ganancia_neta']; ?></td>
					<td><?php echo $keyC['ganancia_bruta']; ?></td>
					<td><?php echo $keyC['cantidas']; ?></td>
					<td><?php echo $keyC['fecha']; ?></td>
					
				</tr>
				<?php } 
			}
				?>
				</table>
			</div>

			<table border="1" class="table table-striped table-dark table-bordered">
				<tr>
					<th>ID</th>
					<th>CLIENTE</th>
					<th>GANANCIA NETA</th>
					<th>GANANCIA BRUTA</th>
					<th>CANTIDAD</th>
					<th>FECHA</th>
				</tr>
				<?php foreach ($row as $key) {
					 ?>
				<tr>
					
					<td><?php echo $key['id']; ?></td>
					<th><?php echo $key['cliente']; ?></th>
					<td><?php echo $key['ganancia_neta']; ?></td>
					<td><?php echo $key['ganancia_bruta']; ?></td>
					<td><?php echo $key['cantidas']; ?></td>
					<td><?php echo $key['fecha']; ?></td>
					
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
	<footer>
		<div class="footer-bg-color">
			<div class="footer-txt-color">
				<?php  
					
				?>
			</div>
		</div>
	</footer>
<script type="text/javascript" src="../../js/bootstrap.js"></script>
</body>
</html>