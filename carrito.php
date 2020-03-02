<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php $pagina = "carrito";
	  $titulo = "Tu compra"; ?>
<?php require_once("inc/encabezado.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<?php 
	if (empty($_SESSION["carrito"])){
	  $mensaje = "Carrito vacío";
	  mostrarMensaje($mensaje);
	  unset($_SESSION["cantProductos"]);
	}else{
		$_SESSION["cantProductos"]=0;
?>
<main role="main">
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Tu carrito</h1>
	  	<a class="btn btn-primary btn-lg" href="productos.php" role="button">Seguir comprando</a>
    </div>
  </div>

  
<div class="container">  
	<div class="row px-5">
	<table class="table table-bordered table-striped">
	  <thead>
		<tr>
		  <th scope="col">Nombre</th>
		  <th scope="col">Cantidad</th>
		  <th scope="col">Precio</th>
		  <th scope="col">Subtotal</th>
		</tr>
	  </thead>
	  <tbody>
		<?php 
		$total = 0;
		foreach ($_SESSION["carrito"] as $id => $cantidad){
			$producto = seleccionarProducto($id);
			
			$idProducto = $producto["idProducto"];
			$nombre = $producto["nombre"];
			$precio = $producto["precioOferta"];
			$subtotal = $precio * $cantidad;
			$total += $subtotal;
			$_SESSION["cantProductos"]++;
		?>
		<tr>
		  <td scope="col"><a href="producto.php?idProducto=<?php echo $idProducto; ?>"><?php echo $nombre; ?></a></td>
		  <td scope="col"><a href="procesarCarrito.php?id=<?php echo $idProducto; ?>&op=remove"><i class="fas fa-minus-circle"></i></a>
		  <?php echo $cantidad; ?> 
		  <a href="procesarCarrito.php?id=<?php echo $idProducto; ?>&op=add"><i class="fas fa-plus-circle"></i></a></td>
		  <td scope="col"><?php echo $precio; ?></td>
		  <td scope="col"><?php echo $subtotal; ?></td>
		</tr>
		<tr>
		<?php } ?>
	  </tbody>
	  <tfoot>
		  <tr>
			<th scope="row" colspan="3" class="text-right">Total</th>
			<th scope="row"><?php echo $total; ?> €</th>
		  </tr>
	  </tfoot>
	</table>
	<p><a class="btn btn-warning btn-lg" href="procesarCarrito.php?op=empty" role="button">Vaciar carrito</a>
	<a class="btn btn-success btn-lg" href="confirmarPedido.php?total=<?php echo $total; ?>" role="button">Confirmar compra</a></p>
	</div>
</div>
	<?php 
	$_SESSION["total"] = $total;
	} //fin else
	?>
</main>
<?php require_once("inc/pie.php"); ?>