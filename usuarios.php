<?php session_start(); ?>
<?php require_once "bbdd/bbdd.php"; ?>
<?php $pagina = "usuarios";
	  $titulo = "Usuarios"; ?>
<?php require_once "inc/encabezado.php"; ?>
<?php require_once "inc/funciones.php"; ?>
<?php if (!isset($_SESSION["admin"]) or $_SESSION["admin"] != 1){header("Location:index.php");} ?>

<main role="main" class="container">
    <h1 class="mt-5">Listado de usuarios</h1>
	<a href="insertarUsuario.php" class="btn btn-outline-success">Nuevo Usuario</a></p>
	<?php 
	$usuarios = seleccionarTodosUsuarios();
	$numUsuarios = count($usuarios);
	
	$usuariosPagina = 2;
	
	$paginas = ceil($numUsuarios/$usuariosPagina);
	
	$npagina = recoge("npagina");
	if (!$npagina || $npagina<=0 || $npagina>$paginas){
		$npagina = 1;
	}
	
	$inicio = ($npagina-1)*$usuariosPagina; //posicion de inicio en el listado de paginas
	$usuarios = seleccionarUsuarios($inicio,$usuariosPagina);
	
	?>
	<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Nombre</th>
      <th scope="col">Password</th>
      <th scope="col">Operaciones</th>
	</tr>
  </thead>
  <tbody>
   <?php
	foreach($usuarios as $usuario){
		$idUsuario = $usuario['idUsuario'];
		$nombre = $usuario['nombre'];
		$password = $usuario['password'];

  ?>
    <tr>
      <th scope="row"><?php echo $idUsuario; ?></th>
      <td><?php echo $nombre; ?></td>
      <td><?php echo $password; ?></td>
	  <td><a href="actualizarUsuario.php?idUsuario=<?php echo $idUsuario; ?>" class="btn btn-outline-primary">Editar</a>
		<a href="borrarUsuario.php?idUsuario=<?php echo $idUsuario; ?>" onClick="return confirmar('¿Realmente quieres borrar el usuario?');" class="btn btn-outline-danger">Borrar</a>
	  </td>
    </tr>
	<?php
	} //Fin foreach usuarios
	?>
  </tbody>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?php if($npagina==1){echo "disabled";} ?>"><a class="page-link" href="usuarios.php?npagina<?php echo $npagina-1; ?>">Anterior</a></li>
    <?php
	 for ($i=1;$i<=$paginas;$i++){
	 ?>
	 <li class="page-item <?php if($npagina==$i){echo "active";} ?>"><a class="page-link" href="usuarios.php?npagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
	 <?php } ?>
    <li class="page-item <?php if($npagina==$paginas){echo "disabled";} ?>"><a class="page-link" href="usuarios.php?npagina=<?php echo $npagina+1; ?>">Siguiente</a></li>
  </ul>
</nav>
</main>
<script>
	function confirmar(Mensaje){		
		return (confirm(Mensaje))?true:false;
	}
</script>
<?php require_once "inc/pie.php"; ?>