<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php $pagina = "detallePedido";
	  $titulo = "Detalles del pedido"; ?>
<?php require_once("inc/funciones.php"); ?>
<?php require_once("inc/encabezado.php"); ?>

<main role="main" class="container">
<h1 class="mt-5">Detalles del pedido</h1>

<?php
$idPedido = recoge("idPedido"); //Recojo el id de la url
$detalles = seleccionarDetallePedido($idPedido);
?>
  <div class="container">
  <table class="table table-striped">
	<thead>
		<tr>
		  <th scope="col">ID Detalle</th>
		  <th scope="col">ID Pedido</th>
		  <th scope="col">ID Producto</th>
		  <th scope="col">Cantidad</th>
		  <th scope="col">Precio</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($detalles as $detalle){
			$idDetalle = $detalle["idDetallePedido"];
			$idPedido = $detalle["idPedido"];
			$idProducto = $detalle["idProducto"];
			$cantidad = $detalle["cantidad"];
			$precio = $detalle["precio"];
		?>
		<tr>
			<td><?php echo $idDetalle; ?></td>
			<td><?php echo $idPedido; ?></td>
			<td><a href="producto.php?idProducto=<?php echo $idProducto; ?>"><?php echo $idProducto; ?></a></td>
			<td><?php echo $cantidad; ?></td>
			<td><?php echo $precio; ?> €</td>
		</tr>
		<?php } ?>
	</tbody>
  </table>
  </div>
    <hr>

  </div> <!-- /container -->

</main>

<?php require_once("inc/pie.php"); ?>
