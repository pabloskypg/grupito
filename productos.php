<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php $pagina = "productos";
	  $titulo = "Todas nuestras ofertas"; ?>
<?php require_once("inc/encabezado.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php
$productos = seleccionarTodasOfertas();
?>

<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Todas nuestras ofertas</h1>
      <p >La tienda con las mejores ofertas de internet que podrás compartir con tu amigos.</p>
      <p><a class="btn btn-primary btn-lg" href="productos.php" role="button">Recargar ofertas »</a></p>
    </div>
  </div>

  <div class="container">
    <!-- Example row of columns -->
<?php mostrarProductos($productos); ?>

    <hr>

  </div> <!-- /container -->

</main>

<?php require_once("inc/pie.php"); ?>
