<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php $pagina = "actualizarPassword";
	  $titulo = "Actualizar password"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<?php
function imprimirFormulario($email){
?>
<form method="post">
	<div class="form-group">
		<label for="pass">Email</label>
		<input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" disabled />
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
	<button type="submit" class="btn btn-primary btn-lg btn-block" name="guardar" value="guardar">Actualizar</button>
</form>
<?php
}
?>

<main role="main" class="container">
    <h1 class="mt-5">Cambiar Contraseña</h1>
<?php
$email = $_SESSION["email"];
if (!isset($_REQUEST['guardar'])){
	$idUsuario = recoge("idUsuario");
	if ($idUsuario == ""){
		header("Location:usuarios.php");
		exit(); //die();
	}
	imprimirFormulario($email);
}else{
	$usuario = seleccionarUsuario($email);
	$idUsuario = $usuario["idUsuario"];
	$password = $usuario["password"];
	$passwordOld = recoge("passold");
	$passwordNew = recoge("passnew");
	$passwordConf = recoge("passconf");
	
	$errores = "";
	
	if ($passwordOld == "" || $passwordNew == "" || $passwordConf == ""){
		$errores = $errores."<li>Tienes que rellenar todos los campos</li>";
	}
	
	if (!password_verify($passwordOld,$usuario["password"])){
		$errores = $errores."<li>Tu contraseña antigua es incorrecta</li>";
	}
	if ($passwordNew != $passwordConf){
		$errores = $errores."<li>Las contraseñas no coinciden</li>";
	}
	if ($passwordOld == $passwordNew){
		$errores = $errores."<li>La nueva contraseña debe ser distinta a la antigua</li>";
	}
	
	if ($errores != ""){
		echo "<ul>$errores</ul>";
		imprimirFormulario($email);
	}else{
		$ok = actualizarPassword($idUsuario,$passwordNew); 
		if ($ok){
		?>
		<p><span class="form-control alert-success">Se ha cambiado la contraseña correctamente</span></p>
		<a class="btn btn-primary" href="misDatos.php">Volver</a>
<?php
		}else{
			echo '<p><span class="form-control alert-danger">No se ha podido cambiar la contraseña</span></p>';
		}
	}
}
?>
</main>

<?php require_once "inc/pie.php"; ?>