<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php $pagina = "pedidos";
	  $titulo = "Pedidos"; ?>
<?php require_once("inc/encabezado.php"); ?>
<?php require_once("inc/funciones.php"); ?>
<?php if (!isset($_SESSION["admin"]) or $_SESSION["admin"] != 1){header("Location:index.php");} ?>
<main role="main" class="container">
    <h1 class="mt-5">Listado de pedidos</h1>
	<?php 
	$pedidos = seleccionarTodosPedidos();
	$numPedidos = count($pedidos);
	
	$pedidosPagina = 3;
	
	$paginas = ceil($numPedidos/$pedidosPagina);
	
	$npagina = recoge("npagina");
	if (!$npagina || $npagina<=0 || $npagina>$paginas){
		$npagina = 1;
	}
	
	$inicio = ($npagina-1)*$pedidosPagina; //posicion de inicio en el listado de paginas
	$pedidos = seleccionarPedidos($inicio,$pedidosPagina);
	
	?>
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">ID usuario</th>
      <th scope="col">Total</th>
      <th scope="col">Fecha</th>
      <th scope="col">Operaciones</th>
	</tr>
  </thead>
  <tbody>
   <?php
	foreach($pedidos as $pedido){
		$idPedido = $pedido['idPedido'];
		$idUsuario = $pedido['idUsuario'];
		$total = $pedido['total'];
		$fecha = $pedido['fecha'];

  ?>
    <tr>
      <th scope="row"><?php echo $idPedido; ?></th>
      <td><?php echo $idUsuario; ?></td>
      <td><?php echo $total; ?> €</td>
      <td><?php echo $fecha; ?></td>
	  <td>
	  <a href="pedido.php?idPedido=<?php echo $idPedido; ?>" class="btn btn-outline-info">Ver Pedido</a>
	  <a href="borrarPedido.php?idUsuario=<?php echo $idPedido; ?>" onClick="return confirmar('¿Realmente quieres borrar el pedido?');" class="btn btn-outline-danger">Borrar</a>
    </tr>
	<?php
	} //Fin foreach usuarios
	?>
  </tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?php if($npagina==1){echo "disabled";} ?>"><a class="page-link" href="pedidos.php?npagina<?php echo $npagina-1; ?>">Anterior</a></li>
    <?php
	 for ($i=1;$i<=$paginas;$i++){
	 ?>
	 <li class="page-item <?php if($npagina==$i){echo "active";} ?>"><a class="page-link" href="pedidos.php?npagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
	 <?php } ?>
    <li class="page-item <?php if($npagina==$paginas){echo "disabled";} ?>"><a class="page-link" href="pedidos.php?npagina=<?php echo $npagina+1; ?>">Siguiente</a></li>
  </ul>
</nav>
</main>
<script>
	function confirmar(Mensaje){		
		return (confirm(Mensaje))?true:false;
	}
</script>
<?php require_once "inc/pie.php"; ?>