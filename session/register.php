<?php 
require('../config/db.php');
if ($_POST) {
  if (!empty($_POST['usuario']) && !empty($_POST['password']) && !empty($_POST['email'])) {
   $insertar=('INSERT INTO users_cakeshop (user,password,email) VALUES (:usuario,:password,:email)');
   $stmt = $conexion->prepare($insertar);
   $stmt->bindParam(':usuario',$_POST['usuario']);
   $stmt->bindParam(':password',$_POST['password']);
   $stmt->bindParam(':email',$_POST['email']);
   if ($stmt->execute()) {
     $message='Se ha registrado con exito';
   }else{
    $message='A ocurrido un error';
   }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Registro</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/specifications.css">
</head>
<body>
	<div class="login-wall-bg">
		<div class="container">
		<div class="row">
			


			<div class="col-md-4 mx-auto mt-5">
				<div class="card" style="width: 18rem;">
  					<div class="card-header">
    					Registro
  					</div>
  					<div class="card-body">
  						<?php if(isset($message)){ ?>
  						<div class="alert alert-danger" role="alert">
  							<?php echo $message; ?>
  						</div>
  						<?php } ?>
  						<form method="POST" >
  						<div class="mb-3">
   						 <label  class="form-label" >Usuario</label>
   						 <input type="text" class="form-control" name="usuario" aria-describedby="emailHelp" placeholder="ejem=rojo243">
  						  <div id="emailHelp" class="form-text">Jamas compartimos tus datos con nadie.</div>
  						</div>
  						<div class="mb-3">
  						  <label  class="form-label">Contraseña</label>
  						  <input type="password" class="form-control" name="password" placeholder="ejem=azul_.3124">
  						</div>
  						<div class="mb-3">
                <label  class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="ejem=azul@3124.com">
              </div>
  						<button type="submit" class="btn btn-primary">Registro</button>
              <a href="login.php" class="btn btn-secondary">Ir al login</a>
						</form>		
               
  					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
<script type="text/javascript" src="../javascript/bootstrap.js"></script>
</body>
</html>