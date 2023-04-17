<?php 
require('../config/db.php');
session_start();
$accion = (isset($_POST['boton']))?$_POST['boton']:"";
$id_txt = (isset($_POST['id_txt']))?$_POST['id_txt']:"";
$name = (isset($_POST['nombre']))?$_POST['nombre']:"";
$date = (isset($_POST['fecha']))?$_POST['fecha']:"";
$monto = (isset($_POST['monto']))?$_POST['monto']:"";
$description = (isset($_POST['desc']))?$_POST['desc']:"";
if(isset($_SESSION['user_id'])){
	$records = $conexion->prepare("SELECT id,user FROM users_cakeshop WHERE id=:id");
	$records->bindParam(':id',$_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);
	$user = null;
	if(count($results)>0){
		$user = $results;
	}
}
else{
		header("Location: ../");
	}
switch ($accion) {
	case 'borrar':
		$r = $conexion->prepare("DELETE FROM apartado_cakeshop WHERE id=:id");
		$r->bindParam(":id",$id_txt);
		$r->execute();
		break;
	case 'seleccionar':
		$r = $conexion->prepare("SELECT * FROM apartado_cakeshop WHERE id=:id");
		$r->bindParam(":id",$id_txt);
		$r->execute();
		$request = $r->fetch(PDO::FETCH_ASSOC);
		$name = $request['name'];
		break;
	case 'modificar':
		$r = $conexion->prepare("UPDATE apartado_cakeshop SET name=:name, date_entrega=:date_entrega, monto_cancelado=:monto_c, description=:descr WHERE id=:id");
		$r->bindParam(":id",$id_txt);
		$r->bindParam(":name",$name);
		$r->bindParam(":date_entrega",$date);
		$r->bindParam(":monto_c",$monto);
		$r->bindParam(":descr",$description);
		$r->execute();
		header("Location: index.php");
		break;
		case 'deseleccionar':
		
		header("Location: index.php");
		break;
	default:
		# code...
		break;
}
$sentenciaSQL= $conexion->prepare("SELECT id, name, number_phone, date_apartado, date_entrega, monto_cancelar, monto_cancelado, description FROM apartado_cakeshop");
$sentenciaSQL->execute();
$tablaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="./../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./../css/specifications.css">
</head>
<body>
	<nav class="navbar nav-bg-color navbar-expand-lg">
  		<div class="container-fluid">
    		<span class="navbar-brand mb-0 h1">Bon & dulce</span>
  		</div>
  		<button class="navbar-toggler nav-toggler-position position-absolute end-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
	  	<a class="nav-link active" aria-current="page" href="./config/gastos.php">Gastos</a>
        <a class="nav-link active" aria-current="page" href="../">Principal</a>
        <a class="nav-link active" href="./config/almacen.php">Almacen</a>
        <a class="nav-link active" href="./config/cerrar.php">Cerrar Sesion</a>
      </div>
    </div>
	</nav>
	<div class="wall-bg-color">
		<div class="container">
<div style="text-align: center; color: red;"><h2>Bienvenido <?php echo $user['user'];?></h2></div>



<div class="title_menu text-center">
	<h1>Bon & dulce</h1>
</div>
<div class="row align-items-start text-center">
<!--Sector Primario-->
<div class="sector_one col">
	<h1>Inventarios</h1>
	<!--Inventario de materia prima-->
    <div class="record_material_inventory d-grid gap-2 col-6 mx-auto" style=>
		<label>Registrar Materia Prima</label>
		<a class="btn btn-primary" href="records\records_material_inventory.php">Registrar</a>
	</div>
	<div class="view_material_inventory d-grid gap-2 col-6 mx-auto">
		<label>Inventario de materia prima</label>
		<a href="records/custom_look_products.php" class="btn btn-primary">Ver Inventario</a>
	</div>
	<!--Inventario de Productos a la venta-->
	<div class="record_products_inventory d-grid gap-2 col-6 mx-auto">
		<label>Registrar Productos</label>
		<a class="btn btn-primary" href="records\records_products_inventory.php">Registrar</a>
	</div>
		<div class="view_products_inventory d-grid gap-2 col-6 mx-auto">
			<label>Inventario de Productos</label>
			<a href="records/look_products.php" class="btn btn-primary">Ver Inventario</a>
		</div>
</div>
<!--imagen-->
    <div class="imagen col ">
		<img src="../images/new.png" height="200" alt="">
	</div>

<!--Segundo Sector-->
<div class="sector_two col ">
	<h1>Ventas</h1>
	<!--Realizar venta-->
	<div class="new_sale d-grid gap-2 col-6 mx-auto">
		<label>Nueva venta</label>
		<a href="sales/new_sale.php" class="btn btn-primary">Registrar Venta</a>
	</div>
	<br>
	<!--Venta Personalizada-->
	<div class="custom_sale d-grid gap-2 col-6 mx-auto">
		<label>Venta Personalizada</label>
		<a href="sales\custom_sale.php" class="btn btn-primary">Crear Venta</a>
	</div>
	<br>
	<div class="view_sale d-grid gap-2 col-6 mx-auto">
		<label>Ventas Realizadas</label>
		<a href="sales/look_sales.php" class="btn btn-primary">Ver Ventas</a>
	</div>

</div>
<!--Sector de apartados-->
<div class="sector_three">
	<h1>Apartados</h1>
	<br>
	<div class="new_reservation btn btn-primary">
		<a href="apartados/apartados.php" class="btn btn-primary">Crear Apartado</a>
	</div>
	<div class="tabla">
		<br>
		<table border="1" class="table table-bordered table-dark table-striped">
			<thead>
				<tr>
					<th>ID</th>
					<th>Nombre</th>
					<th>Telefono</th>
					<th>Fecha de apartado</th>
					<th>Fecha de entrega</th>
					<th>Monto a cancelar</th>
					<th>Monto cancelado</th>
					<th>Descripcion del producto</th>
					<th colspan="2">Opciones</th>
				</tr>
			</thead>
			<?php foreach($tablaProductos as $tabla) { ?>
				<tr>
					<form method="POST" >
					<td><?php echo $tabla['id']; ?></td>
					<td><?php if($tabla['id']!=$id_txt){
						echo $tabla['name'];
					}else{
						echo '<input type="text" id="name" name="nombre" class="input_style_text" value="'.$tabla["name"].'">';
					}
					?>
					</td>
					<td><?php echo $tabla['number_phone']; ?></td>
					<td><?php echo $tabla['date_apartado']; ?></td>
					<td><?php if($tabla['id']!=$id_txt){
						echo $tabla['date_entrega'];
					}else{
						echo '<input type="date" name="fecha" class="input_style_date" value="'.$tabla["date_entrega"].'">';
					} ?></td>
					<td><?php echo $tabla['monto_cancelar']; ?></td>
					<td><?php if($tabla['id']!=$id_txt){
						echo $tabla['monto_cancelado'];
					}else{
						echo '<input type="number" name="monto" class="input_style_number" value="'.$tabla["monto_cancelado"].'">';
					} ?></td>
					<td><?php if($tabla['id']!=$id_txt){
						echo $tabla['description'];
					}else{
						echo '<input type="text" name="desc" class="input_style_text" value="'.$tabla["description"].'">';
					} ?></td>
					<td>
						
							<div class="btn-group">
								<?php 
								if ($accion!="seleccionar") {
									echo '<input type="submit" name="boton" value="borrar" class="btn btn-danger">';
									echo '<input type="submit" name="boton" value="seleccionar" class="btn btn-warning">';

								}else{
									if ($tabla['id']==$id_txt) {
										echo '<input type="submit" name="boton" value="modificar" class="btn btn-success">';
										echo '<input type="submit" name="boton" value="deseleccionar" class="btn btn-secondary">';
									}else{
										echo '<input type="submit" disabled="" name="boton" value="borrar" class="btn btn-danger">';
										echo '<input type="submit" name="boton" value="seleccionar" class="btn btn-warning">';
									}
									
								}
								?>
								
								<input type="hidden" name="id_txt" value="<?php echo $tabla['id']; ?>">
							</div>
						</form>
					</td>
				</tr>
			<?php }?>
		</table>
	</div>
</div>
<div class="s-4-kal33">
	<form method="POST">
		<input type="hidden" name="id_txt" value="<?php echo $id_txt; ?>">

		<input type="hidden" name="nombre" id="" value="<?php echo $name; ?>">
	</form>
</div>
</div>
</div>
	</div>
	<footer>
		<div class="footer-bg-color">
			<div class="footer-txt-color">
				<?php  ?>
			</div>
		</div>
	</footer>
<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="workshop.js"></script>
</body>
</html>
