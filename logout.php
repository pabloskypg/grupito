<?php session_start() ?>
<?php 
unset($_SESSION["usuario"]);
header("Location:index.php");
?>