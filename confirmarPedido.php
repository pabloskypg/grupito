<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php $pagina = "carrito";
	  $titulo = "Tu compra"; ?>
<?php require_once("inc/funciones.php"); ?>
<?php require_once("inc/encabezado.php"); ?>
<?php 
if (!isset($_SESSION["carrito"])){
	header("Location:index");
}else{
	?>
	<main role="main">
	  <!-- Main jumbotron for a primary marketing message or call to action -->
	  <div class="jumbotron">
		<div class="container">
		  <h1 class="display-3">Confirmar compra</h1>
		</div>
	  </div>
	<div class="container">  
	<?php 
	if (!isset($_SESSION["usuario"])){
	?>
		<h4>Para confirmar la compra debes estar logeado</h4>
		<a href="login.php" class="btn btn-info">Login</a>
	<?php	
	}
	else{
		$usuario = seleccionarUsuario($_SESSION["email"]);
		$idUsuario = $usuario["idUsuario"];
		$total = recoge("total");
		$carrito = $_SESSION["carrito"];
		?>
	<?php
		$ok = insertarPedido($idUsuario,$carrito,$total);
		if ($ok){
		unset($_SESSION["carrito"]);
	?>
		<p><span class="form-control alert-success">Su pedido ha sido realizado correctamente</span></p>
		<a class="btn btn-primary" href="index.php">Volver</a>
	<?php
		}else{
			<p><span class="form-control alert-danger">Su pedido no se ha podido realizar</span></p>
		}
	}
}
?>
</div>
</main>
<?php require_once("inc/pie.php"); ?>