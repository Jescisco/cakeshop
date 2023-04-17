<?php 
require('../../config/db.php');
$id_txt = (isset($_POST['id_txt']))?$_POST['id_txt']:"";
$accion = (isset($_POST['boton']))?$_POST['boton']:"";
$fecha=date("Y-m-d H:i:s");
    switch ($accion) {
        case 'Enviar':
            if ($_POST) {
                if (!empty($_POST['nm_clt']) && !empty($_POST['amount']) && !empty($_POST['orden']) && !empty($id_txt)) {
                 $SQL = $conexion->prepare('INSERT INTO custom_orders_cakeshop (nm_clt, orden, amount) VALUES (:nm_clt, :orden, :amount)');
                    $SQL->bindParam(':nm_clt',$_POST['nm_clt']);
                    $SQL->bindParam(':orden',$_POST['orden']);
                    $SQL->bindParam(':amount',$_POST['amount']);
                    $SQL->execute();
                    $c='Se envio correctamente';

                 $quest = $conexion->prepare("SELECT id,amount,price_sell,price_buy FROM products_cakeshop WHERE id=:id");
                 $quest->bindParam(':id',$id_txt);
                 $quest->execute();
                 $sqlquest = $quest->fetch(PDO::FETCH_ASSOC);

                 $cantidad=$_POST['amount'];
                 $cambio_cantidad = $sqlquest['amount'];
                 $cambio_cantidad-= $_POST['amount'];
                 $ganancia_neta=($sqlquest['price_sell']-$sqlquest['price_buy'])*$cantidad;
                 $ganancia_bruta=$sqlquest['price_sell']*$cantidad;
                 $cliente=$_POST['nm_clt'];

                 $quest2 = $conexion->prepare("UPDATE products_cakeshop SET amount=:amount WHERE id=:id");
                 $quest2->bindParam(':id',$id_txt);
                 $quest2->bindParam(':amount',$cambio_cantidad);
                 $quest2->execute();

                  $SQL = $conexion->prepare('INSERT INTO ganancias_cakeshop (cantidas,ganancia_bruta,ganancia_neta,fecha,cliente) VALUES (:cantidas,:ganancia_bruta,:ganancia_neta,:fecha,:cliente)');
                 $SQL->bindParam(':cantidas',$cantidad);
                 $SQL->bindParam(':ganancia_bruta',$ganancia_bruta);
                 $SQL->bindParam(':ganancia_neta',$ganancia_neta);
                 $SQL->bindParam(':fecha',$fecha);
                 $SQL->bindParam(':cliente',$cliente);
                 $SQL->execute();

                 

                }else{
                    $e = 'Rellenar todas las casillas';
                }
            }

            break;
        case 'Seleccionar':
            $sentenciaSQL= $conexion->prepare("SELECT * FROM products_cakeshop WHERE id=:id");
            $sentenciaSQL->bindParam(':id',$id_txt);
            $sentenciaSQL->execute();
            $request=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
            $id_txt = $request['id'];
            break;
    }
$requestSQL = $conexion->prepare('SELECT * FROM products_cakeshop');
$requestSQL->execute();
$listadoSQL = $requestSQL->fetchAll(PDO::FETCH_ASSOC);


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
            <div class="listado_venta">
                <table border="1" class="table table-bordered table-dark table-striped">
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Producto
                        </th>
                        <th>
                            Precio Venta
                        </th>
                        <th>
                            Cantidad
                        </th>
                        <th>Opciones</th>
                    </tr>
                    <?php foreach ($listadoSQL as $lista) { ?>
                    <tr>
                        <td>
                            <?php echo $lista['id']; ?>
                        </td>
                        <td>
                            <?php echo $lista['product']; ?>
                        </td>
                        <td>
                            <?php echo $lista['price_sell']; ?>
                        </td>
                        <td>
                            <?php echo $lista['amount']; ?>
                        </td>
                        <td>
                            <form method="POST" action="">
                                <input type="submit" name="boton" class="btn btn-secondary" value="Seleccionar">
                                <input type="hidden" name="id_txt" value="<?php echo $lista['id'];  ?>"/>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                
                <div class="Registro_productos">
    <h2 class="py-2">Registrar venta</h2>
    <form method="POST" class="formularios-modal">
     <label>Identificador</label>
     <input type="text" name="id_txt" placeholder="ID" readonly="" value="<?php echo $id_txt; ?>">

     <label>Nombre</label>
     <input type="text" name="nm_clt">

     <label>Cantidad</label>
     <input type="number" name="amount">

     <label>Descripcion</label>
     <input type="text" name="orden">

    <input class='formularios-button' type='submit' name='boton' value='Enviar'>
    </form>
    <?php if(isset($e)){?>
    <h5>Error: <?php echo $e;?></h5>
    <?php }else if(isset($c)){echo $c;}?>
                </div>
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