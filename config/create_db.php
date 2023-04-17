<?php 
	$servidor='localhost';
	$nmusuario='root';
	$password="";
	$db = "pasteleriaDB";
	$conexion=new mysqli($servidor,$nmusuario,$password);
	if ($conexion->connect_error) {
		die("Conexion fallida: " . $conexion->connect_error);
	}
	
		$sql = "CREATE DATABASE IF NOT EXISTS pasteleriaDB";
		if ($conexion->query($sql) === true) {

		}else if($conexion->error){
		die("Error al crear la base de datos " . $conexion->error);
		}
	$conexion=new mysqli($servidor,$nmusuario,$password,$db);
	if ($conexion->connect_error) {
		die("Conexion fallida: " . $conexion->connect_error);
	}
		$sql_table1 = "CREATE TABLE IF NOT EXISTS materials_cakeshop(
		id INT(11) not null auto_increment PRIMARY KEY,
		material VARCHAR(255) NOT NULL,
		material_stock INT(11) NOT NULL,
		value INT (11) NOT NULL,
		date TIMESTAMP
	)";
		if ($conexion->query($sql_table1) === true) {
			
		}else if($conexion->error){
		die("Error al crear la tabla de la base de datos 1 " . $conexion->error);
		}
		$sql_table2 = "CREATE TABLE IF NOT EXISTS orders_cakeshop(
		id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		nm_clt VARCHAR(126) NOT NULL,
		orden VARCHAR(255) NOT NULL,
		amount INT(11) NOT NULL,
		date TIMESTAMP
	)";
		if ($conexion->query($sql_table2) === true) {

		}else if($conexion->error){
		die("Error al crear la tabla de la base de datos 2 " . $conexion->error);
		}
		$sql_table3 = "CREATE TABLE IF NOT EXISTS users_cakeshop(
		id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user VARCHAR(32) NOT NULL,
		password VARCHAR(32) NOT NULL,
		email VARCHAR(56) NOT NULL
	)";
	if ($conexion->query($sql_table3) === true) {

		}else if($conexion->error){
		die("Error al crear la tabla de la base de datos 3 " . $conexion->error);
	}
	$sql_table4 = "CREATE TABLE IF NOT EXISTS products_cakeshop(
		id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		product VARCHAR(255) NOT NULL,
		price_sell INT(11) NOT NULL,
		price_buy INT(11) NOT NULL,
		amount INT(11) NOT NULL,
		date TIMESTAMP
	)";
	if ($conexion->query($sql_table4) === true) {

		}else if($conexion->error){
		die("Error al crear la tabla de la base de datos 4 " . $conexion->error);
	}
	$sql_table5 = "CREATE TABLE IF NOT EXISTS apartado_cakeshop(
		id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		name VARCHAR(42) NOT NULL,
		number_phone VARCHAR(12) NOT NULL,
		date_apartado DATE NOT NULL,
		date_entrega DATE NOT NULL,
		monto_cancelar INT(11) NOT NULL,
		monto_cancelado INT(11) NOT NULL,
		description VARCHAR(255) NOT NULL
	)";
	if ($conexion->query($sql_table5) === true) {

		}else if($conexion->error){
		die("Error al crear la tabla de la base de datos 5 " . $conexion->error);
	}
	$sql_table6 = "CREATE TABLE IF NOT EXISTS custom_orders_cakeshop(
		id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		nm_clt VARCHAR(126) NOT NULL,
		orden VARCHAR(255) NOT NULL,
		amount INT(11) NOT NULL,
		date TIMESTAMP
	)";
		if ($conexion->query($sql_table6) === true) {

		}else if($conexion->error){
		die("Error al crear la tabla de la base de datos 6 " . $conexion->error);
		}
	$sql_table7 = "CREATE TABLE IF NOT EXISTS ganancias_cakeshop(
		id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		ganancia_neta INT(11) NOT NULL,
		ganancia_bruta INT(11) NOT NULL,
		cantidas INT(11) NOT NULL,
		cliente VARCHAR(26) NOT NULL,
		fecha DATE
	)";
		if ($conexion->query($sql_table7) === true) {

		}else if($conexion->error){
		die("Error al crear la tabla de la base de datos 7 " . $conexion->error);
		}
	$sql_table8 = "CREATE TABLE IF NOT EXISTS gastos_personales_cakeshop(
		id_gastos INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		descripcion VARCHAR(100) NOT NULL,
		gasto_total INT(7) NOT NULL,
		fecha_compra DATE NOT NULL
		
	)";
		if ($conexion->query($sql_table8) === true) {

		}else if($conexion->error){
		die("Error al crear la tabla de la base de datos 8 " . $conexion->error);
		}
	$sql_table9 = "CREATE TABLE IF NOT EXISTS ganancias_diarias_cakeshop(
		id_ganancias INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
		fecha DATE NOT NULL,
		ganancia_total INT(10) NOT NULL,
		FOREIGN KEY(ganancia_total) REFERENCES orders_cakeshop(id),
		FOREIGN KEY(ganancia_total) REFERENCES custom_orders_cakeshop(id)
	)";
		if ($conexion->query($sql_table9) === true) {

		}else if($conexion->error){
		die("Error al crear la tabla de la base de datos 9 " . $conexion->error);
		}
?>