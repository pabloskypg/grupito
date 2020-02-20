<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php $pagina = "misDatos";
	  $titulo = "Mis Datos"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<?php 
$email = $_SESSION["email"];
$usuario = seleccionarUsuario($email);
$idUsuario = $usuario["idUsuario"];
?>
<main role="main" class="container">
	<h1 class="mt-5">Mis datos</h1><br/>
	<table class="table">
		<tr>
		<th>Nombre<th> 
		<td><?php echo $usuario["nombre"]; ?></td>
		</tr>
		
		<tr>
		<th>Apellidos<th> 
		<td><?php echo $usuario["apellidos"]; ?></td>
		</tr>
		
		<tr>
		<th>Email<th> 
		<td><?php echo $usuario["email"]; ?></td>
		</tr>
		
		<tr>
		<th>Dirección<th> 
		<td><?php echo $usuario["direccion"]; ?></td>
		</tr>
		
		<tr>
		<th>Teléfono<th> 
		<td><?php echo $usuario["telefono"]; ?></td>
		</tr>
	</table>
	<p>
	<a href="actualizarUsuario.php?idUsuario=<?php echo $idUsuario; ?>" class="btn btn-primary">Actualizar datos</a>
	<a href="actualizarPassword.php?idUsuario=<?php echo $idUsuario; ?>" class="btn btn-info">Cambiar contraseña</a>
	</p>
</main>
<?php require_once "inc/pie.php"; ?>