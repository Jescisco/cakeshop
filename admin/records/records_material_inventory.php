<?php 
require('../../config/db.php');
	if ($_POST) {
		if (!empty($_POST['material']) && !empty($_POST['price']) && !empty($_POST['amount'])) {
			$SQL = $conexion->prepare('INSERT INTO materials_cakeshop (material, material_stock, value) VALUES (:material, :material_stock, :value)');
			$SQL->bindParam(':material',$_POST['material']);
			$SQL->bindParam(':material_stock',$_POST['amount']);
			$SQL->bindParam(':value',$_POST['price']);
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
	<div class="Registro_materia_prima">
	<h1>Registrar Materia Prima</h1>
	<form method="POST" class="formularios-modal">
	 <label class="form-label">Producto</label>
	 <input type="text" name="material">

	 <label>Precio Unitario</label>
	 <input type="number" name="price">

	 <label>Cantidad</label>
	 <input type="number" name="amount">

 	 <input type="submit" value="Enviar" class="formularios-button">
	</form>
	<?php if(isset($e)){?>
	<h5>Error: <?php echo $e;?></h5>
	<?php }else if(isset($c)){echo $c;}?>
	</div>


</div>
<!-- falta por decorar -->

</div>
	</div>
	<footer>
		<div class="footer-bg-color">
			<div class="footer-txt-color">
				
			</div>
		</div>
	</footer>
<script type="text/javascript" src="../../js/bootstrap.js"></script>
</body>
</html>