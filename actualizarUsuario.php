<?php require_once "bbdd/bbdd.php"; ?>
<?php $pagina = "actualizar";
	  $titulo = "Actualizar usuario"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<?php
function imprimirFormulario($idUsuario,$nombre,$apellidos,$email,$direccion,$telefono){
?>
<form method="post">
	<div class="form-group">
		<label for="nombre">ID</label>
		<input type="text" class="form-control" id="id" name="id" value="<?php echo $idUsuario; ?>" disabled />
	</div>
	<div class="form-group">
		<label for="nombre">Nombre</label>
		<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>"/>
	</div>
	<div class="form-group">
		<label for="pass">Apellidos</label>
		<input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos; ?>"/>
	</div>
	<div class="form-group">
		<label for="pass">Email</label>
		<input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>"/>
	</div>
	<div class="form-group">
		<label for="pass">Contraseña antigua</label>
		<input type="password" class="form-control" id="passold" name="passold"/>
	</div>
	<div class="form-group">
		<label for="pass">Nueva contraseña</label>
		<input type="password" class="form-control" id="passnew" name="passnew"/>
	</div>
	<div class="form-group">
		<label for="pass">Confirmar contraseña</label>
		<input type="password" class="form-control" id="passconf" name="passconf"/>
	</div>
	<div class="form-group">
		<label for="pass">Dirección</label>
		<input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion; ?>"/>
	</div>
	<div class="form-group">
		<label for="pass">Teléfono</label>
		<input type="text" class="form-control" id="tlf" name="tlf" value="<?php echo $telefono; ?>"/>
	</div>
	<button type="submit" class="btn btn-primary btn-lg btn-block" name="guardar" value="guardar">Actualizar</button>
</form>
<?php
}
?>

<main role="main" class="container">
    <h1 class="mt-5">Actualizar usuario</h1>
<?php
if (!isset($_REQUEST['guardar'])){
	$idUsuario = recoge("idUsuario");
	if ($idUsuario == ""){
		header("Location:usuarios.php");
		exit(); //die();
	}
	$usuario = seleccionarUsuario($idUsuario);
	if (empty($idUsuario)){
		header("Location:index.php");
		exit();
	}
	$idUsuario = $idUsuario;
	$nombre = $usuario['nombre'];
	$apellidos = $usuario['apellidos'];
	$email = $usuario['email'];
	$direccion = $usuario['direccion'];
	$telefono = $usuario['telefono'];
	imprimirFormulario($idUsuario,$nombre,$apellidos,$email,$direccion,$telefono);
}else{
	$passwordOld = recoge("passold");
	$passwordNew = recoge("passnew");
	$passwordConf = recoge("passconf");
	password_hash($passwordOld,PASSWORD_DEFAULT);
	
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
		$errores = $errores."<li>Introduce la contraseña</li>";
	}
	if ($direccion == ""){
		$errores = $errores."<li>Introduce tu dirección</li>";
	}
	if ($telefono == ""){
		$errores = $errores."<li>Introduce un numero de telefono</li>";
	}
	
	$errores = "";
	if ($passwordOld != $usuario['password']){
		$errores = $errores."<li>La contraseña antigua no es correcta</li>";
	}
	if ($passwordNew != $passwordConf){
		$errores = $errores."<li>Las contraseñas no coinciden</li>";
	}
	
	if ($errores != ""){
		echo "<ul>$errores</ul>";
	}else{
		actualizarUsuario($nombre,$apellidos,$email,$passwordNew,$direccion,$telefono);
	}
}
?>
</main>

<?php require_once "inc/pie.php"; ?>