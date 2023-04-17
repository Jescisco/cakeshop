<?php 
require('../../config/db.php');
    if ($_POST) {
        if (!empty($_POST['name']) && !empty($_POST['price_sell']) && !empty($_POST['price_buy']) && !empty($_POST['amount'])) {
            $SQL = $conexion->prepare('INSERT INTO products_cakeshop (product, price_sell, price_buy, amount) VALUES (:product, :price_sell, :price_buy, :amount)');
            $SQL->bindParam(':product',$_POST['name']);
            $SQL->bindParam(':price_sell',$_POST['price_sell']);
            $SQL->bindParam(':price_buy',$_POST['price_buy']);
            $SQL->bindParam(':amount',$_POST['amount']);
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
<div class="registro_productos">
    <h1>Registrar Productos</h1>
    <form method="POST" class="formularios-modal">
     <label>Nombre</label>
     <input type="text" name="name">

     <label>Precio Costo</label>
     <input type="number" name="price_buy">

     <label>Precio Venta</label>
     <input type="number" name="price_sell">

     <label>Cantidad</label>
     <input type="number" name="amount">

     <input type="submit" value="Enviar" class="formularios-button">
    </form>
    <?php if(isset($e)){?>
    <h5>Error: <?php echo $e;?></h5>
    <?php }else if(isset($c)){echo $c;}?>
</div>


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