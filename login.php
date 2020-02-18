<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php $pagina = "login";
	  $titulo = "Login"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<?php 
function imprimirFormulario(){
?>
<form method="post">
<main role="main" class="container">
	<h2 class="mt-5">Inicio de sesión</h2> 
	<div class="form-group">
		<label for="nombre">Email</label>
		<input type="email" class="form-control" id="email" name="email"/>
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
	$email = recoge("email");
	$password = recoge("pass");
	
	$errores = "";
	
	if ($email == ""){
		$errores = $errores."<li>Introduce tu email</li>";
	}
	if ($password == ""){
		$errores = $errores."<li>Introduce tu contraseña</li>";
	}
	if ($errores != ""){
		echo "<ul>$errores</ul>";
		imprimirFormulario();
	}else{
		$usuario = seleccionarUsuario($email);
		if (password_verify($password,$usuario['password'])){
			$_SESSION["usuario"] = $usuario["nombre"];
			$_SESSION["email"] = $usuario["email"];
			$_SESSION["admin"] = $usuario["admin"];
			header("Location:index.php");
		}else{
			echo "El usuario o la contraseña son incorrectos";
			imprimirFormulario($email);
		}
	}
}


?>
<?php require_once("inc/pie.php"); ?>