<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<?php 
function imprimirFormulario(){
?>
<form method="post">
<main role="main" class="container">
	<h2 class="mt-5">Inicio de sesión</h2> 
	<div class="form-group">
		<label for="nombre">Nombre</label>
		<input type="text" class="form-control" id="nombre" name="nombre"/>
	</div>
	<div class="form-group">
		<label for="pass">Contraseña</label>
		<input type="password" class="form-control" id="pass" name="pass"/>
	</div>
	<p>
	<input type="submit" class="btn btn-primary btn-lg btn-block" value="Acceder"/>
	<a href="insertarUsuario.php" class="btn btn-secondary btn-lg btn-block">Registrarse</a>
	</p>
</form>
<?php
}

if (empty($_POST)){
	imprimirFormulario();
}else{
	$nombre = recoge("nombre");
	$password = recoge("pass");
	
	$errores = "";
	
	if ($nombre == ""){
		$errores = $errores."<li>Introduce el nombre de usuario</li>";
	}
	if ($password == ""){
		$errores = $errores."<li>Introduce la contraseña</li>";
	}
	
	if ($errores != ""){
		echo "<ul>$errores</ul>";
		imprimirFormulario();
	}else{
		$usuario = seleccionarUsuario($nombre);
		$password = password_hash($password,PASSWORD_DEFAULT);
		echo $usuario['password']."<br/>".$password;
		if ($password == $usuario['password']){
			$_SESSION["nombre"] = $nombre;
			header("Location:index.php");
		}else{
			echo "El usuario o la contraseña son incorrectos";
			imprimirFormulario($nombre);
		}
	}
}


?>