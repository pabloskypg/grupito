<?php session_start() ?>
<?php 
unset($_SESSION["usuario"]);
unset($_SESSION["admin"]);
header("Location:index.php");
?>