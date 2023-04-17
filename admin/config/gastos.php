<?php 
require('../../config/db.php');
$descripcion = (isset($_POST['desc_g']))?$_POST['desc_g']:"";
$gasto = (isset($_POST['gasto_g']))?$_POST['gasto_g']:"";
$fecha = date("Y-m-d");
$accion = (isset($_POST['accion']))?$_POST['accion']:"";

if(!empty($descripcion) && !empty($gasto)){
    if(is_numeric($gasto)){

    
        $records = $conexion->prepare("INSERT INTO gastos_personales_cakeshop(descripcion, gasto_total, fecha_compra) VALUES(:descripcion, :gasto_total, :fecha_compra)"); 
        $records->bindParam(':descripcion',$descripcion);
        $records->bindParam(':gasto_total',$gasto);
        $records->bindParam(':fecha_compra',$fecha);
        $records->execute();

        if($records){

        }

    }else{
        $e = "Debe ser una variable numerica para trabajar con ella";
        
    }
}

if(!empty($accion)){
    if($accion=="Mostrar"){
        //Ganancias
        $records2 = $conexion->prepare("SELECT SUM(ganancia_neta) AS gananciaD, fecha FROM ganancias_cakeshop GROUP BY fecha ORDER BY fecha");
        $records2->execute();
        $fetch = $records2->fetchAll(PDO::FETCH_ASSOC);
        //Costos
        $records3 = $conexion->prepare("SELECT SUM(gasto_total) AS gastoD, fecha_compra FROM gastos_personales_cakeshop GROUP BY fecha_compra ORDER BY fecha_compra");
        $records3->execute();
        $fetch2 = $records3->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../../css/specifications.css">
    <title>Gastos</title>
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
        <a class="nav-link active" aria-current="page" href="./config/gastos.php">Gastos</a>
        <a class="nav-link active" aria-current="page" href="../">Principal</a>
        <a class="nav-link active" href="../config/almacen.php">Almacen</a>
        <a class="nav-link active" href="./config/cerrar.php">Cerrar Sesion</a>
      </div>
    </div>
	</nav>
    <div class="container-fluid wall-bg-color">
        <h1>Formulario de Prueba</h1>
        <form method="POST">
            <label for="t1">Descripcion del gasto a realizar</label>
            <input type="text" name="desc_g">
            <label for="t2">Cantidad de dinero a gastar</label>
            <input type="text" name="gasto_g">
            <input type="submit" name="accion">
        </form>
        <h2>Tabla de ganancias diarias</h2>
        <form method="POST">
            <input type="submit" value="Mostrar" name="accion">
        </form>
        <?php if(!empty($fetch)){
            $fechaImpresa=[];
            $fechaImpresa2=[];
            $fechaImpresa_gastos = [];
            foreach($fetch as $key => $value){
                foreach($fetch2 as $key2 => $value2){
                    if($value["fecha"]==$value2["fecha_compra"] && !in_array($value["fecha"], $fechaImpresa)){
                        $efectivo = $value["gananciaD"]-$value2["gastoD"];
                        echo "<br> Fecha: ",$value["fecha"]," Dinero total: ",$efectivo, " de ",$value["gananciaD"];
                        $fechaImpresa[] = $value["fecha"];

                    }elseif($value["fecha"]!=$value2["fecha_compra"] && (!in_array($value["fecha"], $fechaImpresa2) && !in_array($value["fecha"], $fechaImpresa))){
                        echo "<br> Fecha: ",$value["fecha"]," Dinero total: ",$value["gananciaD"];
                        $fechaImpresa2[] = $value["fecha"];

                    }elseif($value2["fecha_compra"] != $value["fecha"] && (!in_array($value2["fecha_compra"], $fechaImpresa_gastos))){
                        echo "<br> Fecha: ",$value2["fecha_compra"]," Dinero total: ",-1*$value2["gastoD"], " al parecer este dia no se genero ganancias...";
                        $fechaImpresa_gastos[] = $value2["fecha_compra"];

                    }

                }
                
            }
        } ?>
    </div>
    <?php 
    if(!empty($e)){
        echo $e;
    } ?>
</body>
</html>