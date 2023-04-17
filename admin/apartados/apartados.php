<?php 
require('../../config/db.php');
$fecha = (isset($_POST['date_apartado']))?$_POST['date_apartado']:date("Y-m-d");
$monto_cancelado = (isset($_POST['monto_cancelado']))?$_POST['monto_cancelado']:"";
	if ($_POST) {
		if (!empty($_POST['name']) && !empty($_POST['number_phone']) && isset($fecha) && !empty($_POST['date_entrega']) && !empty($_POST['monto_cancelar']) && isset($monto_cancelado) && !empty($_POST['description'])) {
			$SQL = $conexion->prepare('INSERT INTO apartado_cakeshop (name, number_phone, date_apartado, date_entrega, monto_cancelar, monto_cancelado, description) VALUES (:name, :number_phone, :date_apartado, :date_entrega, :monto_cancelar, :monto_cancelado, :description)');
			$SQL->bindParam(':name',$_POST['name']);
			$SQL->bindParam(':number_phone',$_POST['number_phone']);
			$SQL->bindParam(':date_entrega',$_POST['date_entrega']);
			$SQL->bindParam(':date_apartado',$fecha);
			$SQL->bindParam(':monto_cancelar',$_POST['monto_cancelar']);
			$SQL->bindParam(':monto_cancelado',$monto_cancelado);
			$SQL->bindParam(':description',$_POST['description']);
			$SQL->execute();
			$c='Se envio correctamente';
		}else{
			$e = 'Rellenar todas las casillas';
		}
	}

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
<div class="mb-3">
	<div class="Registro_apartados">
	<h1>Registrar Apartado Nuevo</h1>
	<form method="POST" class="formularios-modal">
	 <label class="form-label">Nombre</label>
	 <input type="text" name="name">

	 <label class="form-label">Numero de Telefono</label>
	 <input type="text" name="number_phone">

	 <label class="form-label">Fecha de Apartado</label>
	 <input type="date" name="date_apartado">

	 <label class="form-label">Fecha de Entrega</label>
	 <input type="date" name="date_entrega">

	 <label>Monto a Cancelar</label>
	 <input type="number" name="monto_cancelar">

	 <label>Monto Cancelado</label>
	 <input type="number" name="monto_cancelado">

	 <label class="form-label">Descripcion del Pedido</label>
	 <input type="text" name="description">

 	 <input class="formularios-button" type="submit" value="Enviar">
	</form>
	<?php if(isset($e)){?>
	<h5>Error: <?php echo $e;?></h5>
	<?php }else if(isset($c)){echo $c;}?>
	</div>


</div>
<a href="..\index.php">volver al menu</a>
<!-- falta por decorar -->

</div>
	</div>
	<footer>
		<div class="footer-bg-color">
			<div class="footer-txt-color">
				<?php echo var_dump($fecha); ?>
			</div>
		</div>
	</footer>
<script type="text/javascript" src="../../js/bootstrap.js"></script>
</body>
</html>