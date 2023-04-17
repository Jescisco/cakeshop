<?php 
require("../../config/db.php");
$sqlRequest = $conexion->prepare("SELECT * FROM orders_cakeshop ORDER BY date ASC");
$sqlRequest->execute();
$tabla1 = $sqlRequest->fetchAll(PDO::FETCH_ASSOC);

$sqlRequest1 = $conexion->prepare("SELECT * FROM custom_orders_cakeshop ORDER BY date ASC");
$sqlRequest1->execute();
$tabla2 = $sqlRequest1->fetchAll(PDO::FETCH_ASSOC);



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
    		<a href="../" class="navbar-brand mb-0 h1">Bon & dulce</a>
  		</div>
  		<button class="navbar-toggler nav-toggler-position position-absolute end-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="../">Principal</a>
        <a class="nav-link active" href="../config/almacen.php">Almacen</a>
        <a class="nav-link active" href="../config/cerrar.php">Cerrar Sesion</a>
      </div>
    </div>
	</nav>
	<div class="wall-bg-color">
		<div class="container">
            
            <table class="table table-striped table-dark table-bordered">
            <?php echo"<h2>Tabla de Ventas</h2>";?>
                <thead>
                    <tr>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Cantidad que Compro
                        </th>
                        <th>
                            Descripcion de la compra
                        </th>
                        <th>
                            Fecha
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tabla1 as $m1){ ?>
                    <tr>
                        <td><?php echo $m1['nm_clt']; ?></td>
                        <td><?php echo $m1['amount']; ?></td>
                        <td><?php echo $m1['orden']; ?></td>
                        <td><?php echo $m1['date']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody
            </table>
            
            
            <table class="table table-striped table-dark table-bordered">
            <?php echo"<h2>Tabla de ventas personalizadas</h2>";?>
            <thead>
                    <tr>
                        <th>
                            Nombre
                        </th>
                        <th>
                            Cantidad que Compro
                        </th>
                        <th>
                            Descripcion de la compra
                        </th>
                        <th>
                            Fecha
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tabla2 as $m2){ ?>
                    <tr>
                        <td><?php echo $m2['nm_clt']; ?></td>
                        <td><?php echo $m2['amount']; ?></td>
                        <td><?php echo $m2['orden']; ?></td>
                        <td><?php echo $m2['date']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody
            </table>
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
<script type="text/javascript" src="../../js/bootstrap.js"></script>
<script type="text/javascript" src="../workshop.js"></script>
</body>
</html>