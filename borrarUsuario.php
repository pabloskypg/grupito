<?php require_once "bbdd/bbdd.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<main role="main" class="container">
    <h1 class="mt-5">Borrar usuario</h1>
	
<?php
if (!isset($_REQUEST['guardar'])){
	$idUsuario = recoge("idUsuario");
	if ($idUsuario == ""){
			header("Location:usuarios.php");
			exit(); //die();
	}

	$ok = borrarUsuario($idUsuario);
	if ($ok){
		echo "<div class='alert alert-success' role='alert'>Usuario $idUsuario borrado correctamente</div>";
	}else{
		echo "ERROR: No se ha podido borrar el usuario";
	}
	echo "<p><a href='usuarios.php'>Volver al listado de usuarios</a></p>";
}
?>
</main>

<?php require_once "inc/pie.php"; ?>