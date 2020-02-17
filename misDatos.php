<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php $pagina = "misDatos";
	  $titulo = "Mis Datos"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php require_once "inc/encabezado.php"; ?>

<?php 
$email = $_SESSION["email"];
$usuario = $seleccionarUsuario($email)



?>


<?php require_once "inc/pie.php"; ?>