<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php
$idProducto = recoge("idProducto"); //Recojo el id de la url
$producto = seleccionarProducto($idProducto);

$nombre = $producto["nombre"];
$introDescripcion = $producto["introDescripcion"];
$descripcion = $producto["descripcion"];
$imagen = $producto["imagen"];
$precio = $producto["precio"];
$precioOferta = $producto["precioOferta"];
?>
<?php $pagina = "productos";
	  $titulo = $nombre; ?>
<?php require_once("inc/encabezado.php"); ?>


<main role="main">

  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3"><?php echo $nombre; ?></h1>
      <p >La tienda con las mejores ofertas de internet que podrás compartir con tu amigos.</p>
      <p><a class="btn btn-primary btn-lg" href="productos.php" role="button">Nuestras ofertas »</a></p>
    </div>
  </div>

  <div class="container">

	<div class="row col-10 mx-auto">
		<div class="col-6 mx-auto">
			<p><?php echo $descripcion; ?></p>
			
			<div class="col-12 mx-auto d-flex justify-content-center">
				<a href="procesarCarrito.php?id=<?php echo $idProducto; ?>&op=add" class="btn btn-success text-justify">Añadir al carrito</a>
			</div>
		</div>
		<div class="col-6 mx-auto">
			<img src="imagenes/<?php echo $imagen; ?>" alt="<?php echo $nombre; ?>" class="card-img-top rounded"/>
			
			<div class="row mt-2 mx-auto">
				<span class="text-danger col-6 text-center display-4">Antes <del><?php echo $producto["precio"]; ?> €</del></span>
				<span class="text-success col-6 text-center display-4">Ahora <?php echo $producto["precioOferta"]; ?> €</span>
			</div>
		</div>
	</div>
    <hr>

  </div> <!-- /container -->

</main>

<?php require_once("inc/pie.php"); ?>
