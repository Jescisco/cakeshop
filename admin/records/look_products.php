<?php 
require('../../config/db.php');
$id_txt = (isset($_POST['id_txt']))?$_POST['id_txt']:"";
$accion = (isset($_POST['boton']))?$_POST['boton']:"";
$txt_product = (isset($_POST['producto']))?$_POST['producto']:"";
$txt_prc_s = (isset($_POST['prc_vnt']))?$_POST['prc_vnt']:"";
$txt_prc_b = (isset($_POST['prc_cmp']))?$_POST['prc_cmp']:"";
$txt_amount = (isset($_POST['cantidad']))?$_POST['cantidad']:"";
$txt_date = (isset($_POST['fecha']))?$_POST['fecha']:"";
$fechaH = date("Y-m-d H:i:s");

error_reporting(E_ALL && ~E_DEPRECATED);
ini_set("display_errors", 1);
switch ($accion) {
	case 'Seleccionar':
		$sql = $conexion->prepare("SELECT * FROM products_cakeshop WHERE id=:id");
		$sql->bindParam(":id",$id_txt);
		$sql->execute();
		$request = $sql->fetch(PDO::FETCH_ASSOC);
		$txt_product = $request['product'];
		$txt_prc_b = $request['price_buy'];
		$txt_prc_s = $request['price_sell'];
		$txt_amount = $request['amount'];
		$txt_date = $request['date'];
		break;
	case 'Editar':

			$sql2 = $conexion->prepare("UPDATE products_cakeshop SET product=:product, price_sell=:price_sell, price_buy=:price_buy, amount=:amount, date=:date WHERE id=:id");
					 $sql2->bindParam(":id",$id_txt);
			$sql2->bindParam(":price_sell",$txt_prc_s);
			$sql2->bindParam(":price_buy",$txt_prc_b);
			$sql2->bindParam(":product",$txt_product);
			$sql2->bindParam(":amount",$txt_amount);
			$sql2->bindParam(":date",$fechaH);
			$sql2->execute();
			header("Location: look_products.php");
		break;
	case 'Deseleccionar':
		header("Location: look_products.php");
		break;
	default:
		# code...
		break;
}
	$sentenciaSQL= $conexion->prepare("SELECT id, product, price_sell, price_buy, amount, date FROM products_cakeshop");
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
					<th>Producto</th>
					<th>Precio Venta</th>
					<th>Precio Compra</th>
					<th>Cantidad</th>
					<th>Fecha</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<?php foreach($tablaProductos as $tabla) { ?>
				<tr>
					<td><?php echo $tabla['id']; ?></td>
					<td><?php echo $tabla['product']; ?></td>
					<td><?php echo $tabla['price_sell']; ?></td>
					<td><?php echo $tabla['price_buy']; ?></td>
					<td><?php echo $tabla['amount']; ?></td>
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

				<label>Nombre Producto</label>
				<input type="text" name="producto" value="<?php echo $txt_product; ?>">

				<label>Precio Venta</label>
				<input type="number" name="prc_vnt" value="<?php echo $txt_prc_s; ?>">

				<label>Precio Compra</label>
				<input type="number" name="prc_cmp" value="<?php echo $txt_prc_b; ?>">

				<label>Cantidad</label>
				<input type="number" name="cantidad" value="<?php echo $txt_amount; ?>">

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