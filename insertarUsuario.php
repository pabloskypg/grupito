<?php require_once "bbdd/bbdd.php"; ?>
<?php $pagina = "insertarUsuario";
	  $titulo = "Registrar usuario"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<?php 
function imprimirFormulario($nombre,$apellidos,$email,$direccion,$telefono){
?>
<form method="post">
<main role="main" class="container">
	<h2 class="mt-5">Crear usuario</h2> 
	<div class="form-group">
		<label for="nombre">Nombre</label>
		<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>"/>
	</div>
	<div class="form-group">
		<label for="apellidos">Apellidos</label>
		<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>"/>
	</div>
	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>"/>
	</div>
	<div class="form-group">
		<label for="pass">Contraseña</label>
		<input type="password" class="form-control" id="pass" name="pass"/>
	</div>
	<div class="form-group">
		<label for="direccion">Dirección</label>
		<input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion; ?>"/>
	</div>
	<div class="form-group">
		<label for="tlf">Teléfono</label>
		<input type="text" class="form-control" id="tlf" name="tlf" value="<?php echo $telefono; ?>"/>
	</div>
	
	<input type="hidden" name="recaptcha_response" id="recaptchaResponse">
	
	<p>
	<button type="submit" class="btn btn-primary btn-lg btn-block" value="guardar">Crear</button>
	<a href="login.php" class="btn btn-secondary btn-lg btn-block">Volver</a>
	</p>
</form>
<?php
}

if (empty($_POST)){
	$nombre = "";
	$apellidos = "";
	$email = "";
	$password = "";
	$direccion = "";
	$telefono = "";
	$errores = "";
	imprimirFormulario($nombre,$apellidos,$email,$direccion,$telefono);
}else{
	$nombre = recoge("nombre");
	$apellidos = recoge("apellidos");
	$email = recoge("email");
	$password = recoge("pass");
	$direccion = recoge("direccion");
	$telefono = recoge("tlf");
	
	$errores = "";
	
	//Validar reCaptcha
	$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify'; 
	$recaptcha_secret = CLAVE_SECRETA; 
	$recaptcha_response = recoge('recaptcha_response'); 
	$recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response); 
	$recaptcha = json_decode($recaptcha); 

	/*if($recaptcha->score <=0.7){
	  $errores = $errores."<li><strong>DETECTADO ROBOT</strong></li>";
	}*/
	
	if ($nombre == ""){
		$errores = $errores."<li>Introduce tu nombre</li>";
	}
	if ($apellidos == ""){
		$errores = $errores."<li>Introduce tus apellidos</li>";
	}
	if ($email == ""){
		$errores = $errores."<li>Introduce tu email</li>";
	}
	if ($password == ""){
		$errores = $errores."<li>Introduce una contraseña</li>";
	}
	if ($direccion == ""){
		$errores = $errores."<li>Introduce tu dirección</li>";
	}
	if ($telefono == ""){
		$errores = $errores."<li>Introduce un numero de telefono</li>";
	}
	
	if ($errores != ""){
		echo "<ul>$errores</ul>";
		imprimirFormulario($nombre,$apellidos,$email,$direccion,$telefono);
	}else{
		insertarUsuario($nombre,$apellidos,$email,$password,$direccion,$telefono);
		header("Location:login.php");
	}
}
?>
<?php require_once "inc/pie.php"; ?>