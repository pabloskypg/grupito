<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php 
if (!isset("usuario")){
	echo "Tienes que logearte";
}
else{}
?>