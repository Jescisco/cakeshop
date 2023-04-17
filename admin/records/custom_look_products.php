<?php 
require('../../config/db.php');
$id_txt = (isset($_POST['id_txt']))?$_POST['id_txt']:"";
$accion = (isset($_POST['boton']))?$_POST['boton']:"";
$txt_material = (isset($_POST['m']))?$_POST['m']:"";
$txt_material_s = (isset($_POST['ms']))?$_POST['ms']:"";
$txt_value = (isset($_POST['prc']))?$_POST['prc']:"";
$txt_date = (isset($_POST['fecha']))?$_POST['fecha']:"";
$fechaH = date("Y-m-d H:i:s");

error_reporting(E_ALL && ~E_DEPRECATED);
ini_set("display_errors", 1);
switch ($accion) {
	case 'Seleccionar':
		$sql = $conexion->prepare("SELECT * FROM materials_cakeshop WHERE id=:id");
		$sql->bindParam(":id",$id_txt);
		$sql->execute();
		$request = $sql->fetch(PDO::FETCH_ASSOC);
		$txt_material = $request['material'];
		$txt_material_s = $request['material_stock'];
		$txt_value = $request['value'];
		$txt_date = $request['date'];
		break;
	case 'Editar':

			$sql2 = $conexion->prepare("UPDATE materials_cakeshop SET material=:material, material_stock=:material_stock, value=:value, date=:date WHERE id=:id");
					 $sql2->bindParam(":id",$id_txt);
			$sql2->bindParam(":material",$txt_material);
			$sql2->bindParam(":material_stock",$txt_material_s);
			$sql2->bindParam(":value",$txt_value);
			$sql2->bindParam(":date",$fechaH);
			$sql2->execute();
			header("Location: custom_look_products.php");
		break;
	case 'Deseleccionar':
		header("Location: custom_look_products.php");
		break;
	default:
		# code...
		break;
}
	$sentenciaSQL= $conexion->prepare("SELECT * FROM materials_cakeshop");
	$sentenciaSQL->execute();
	$tablaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
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
        <a class="nav-link active" href="./config/almacen.php">Almacen</a>
        <a class="nav-link active" href="./config/cerrar.php">Cerrar Sesion</a>
      </div>
    </div>
	</nav>
	<div class="wall-bg-color">
		<div class="container">
			<div class="tabla">
		<table border="1" class="table table-bordered table-dark table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Material</th>
					<th>Cantidad </th>
					<th>Precio</th>
					<th>Fecha</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<?php foreach($tablaProductos as $tabla) { ?>
				<tr>
					<td><?php echo $tabla['id']; ?></td>
					<td><?php echo $tabla['material']; ?></td>
					<td><?php echo $tabla['material_stock']; ?></td>
					<td><?php echo $tabla['value']; ?></td>
					<td><?php echo $tabla['date']; ?></td>
					<td>
						<form method="POST">
							<input type="submit" name="boton" value="Seleccionar" class="btn btn-secondary">
							<input type="hidden" name="id_txt" value="<?php echo $tabla['id']; ?>">
						</form>
					</td>
				</tr>
			<?php } ?>
		</table>
			</div>
			<form method="POST" class="formularios-modal" enctype="multipart/form-data">
				<label>ID</label>
				<input type="text" name="id_txt" readonly="" value="<?php echo $id_txt; ?>">

				<label>Nombre Material</label>
				<input type="text" name="m" value="<?php echo $txt_material; ?>">

				<label>Cantidad Material</label>
				<input type="number" name="ms" value="<?php echo $txt_material_s; ?>">

				<label>Precio</label>
				<input type="number" name="prc" value="<?php echo $txt_value; ?>">

				<label>Fecha en la que se subio el producto</label>
				<input type="text" name="fecha" readonly="" value="<?php echo $txt_date; ?>">
				<?php if($accion!="Seleccionar"){ echo '<input type="submit" disabled="" class="my-1 btn btn-success" name="boton" value="Editar">';}else{echo '<input type="submit" class="my-1 btn btn-success" name="boton" value="Editar">';} ?>
					
					<input type="submit" class="my-1 btn btn-secondary" name="boton" value="Deseleccionar">
					
			</form>
		</div>
	</div>
	<footer>
		<div class="footer-bg-color">
			<div class="footer-txt-color">
				<?php  ?>
			</div>
		</div>
	</footer>
<script type="text/javascript" src="../../js/bootstrap.js"></script>
</body>
</html>