<?php require_once("configuracion.php"); ?>

<?php
// Función para conectarnos a la base de datos
function conectarBD(){
	try{
		$con = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8",USER,PASS);
		
		$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	}catch(PDOException $e){
		echo "Error: Error al conectar a la BD: ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $con;
}

// Función para desconectar BD
function desconectarBD($con){
	$con = NULL;
	return $con;
}


function seleccionarOfertasPortada($numOfertas){
	
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM productos WHERE online=1 LIMIT :numOfertas";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':numOfertas',$numOfertas, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar las ofertas".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}



function seleccionarTodasOfertas(){
	
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM productos WHERE online=1";
		
		$stmt = $con->prepare($sql);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC); 
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar las ofertas".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}


function seleccionarProducto($idProducto){
	
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM productos WHERE idProducto=:idProducto";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idProducto',$idProducto, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar la oferta".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $row;
}

function borrarProducto($idProducto){
	
	$con = conectarBD();
	
	try{
		$sql = "UPDATE FROM productos SET online=0 WHERE idProducto=:idProducto";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idProducto',$idProducto, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 
		
	}catch(PDOException $e){
		echo "Error: Error al borrar el producto".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $row;
}

//-------------------------------------------------------------------------------------------------------------
//USUARIOS
//-------------------------------------------------------------------------------------------------------------

// Funcion crearUsuario
function insertarUsuario($nombre,$apellidos,$email,$password,$direccion,$telefono){
	
	$con = conectarBD();
	
	try{
		$sql = "INSERT INTO usuarios(nombre,apellidos,email,password,direccion,telefono) values(:nombre,:apellidos,:email,:password,:direccion,:telefono)";
		$password = password_hash($password,PASSWORD_DEFAULT);
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':apellidos',$apellidos);
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':password',$password);
		$stmt->bindParam(':direccion',$direccion);
		$stmt->bindParam(':telefono',$telefono);
		
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: Error al crear el usuario ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
}

// password_verify($password,$password_encriptada);

// Funcion actualizarUsuario
function actualizarUsuario($idUsuario,$nombre,$apellidos,$direccion,$telefono){
	
	$con = conectarBD();
	
	try{
		$sql = "UPDATE usuarios SET nombre=:nombre,apellidos=:apellidos,direccion=:direccion,telefono=:telefono WHERE idUsuario=:idUsuario";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idUsuario',$idUsuario);
		$stmt->bindParam(':nombre',$nombre);
		$stmt->bindParam(':apellidos',$apellidos);
		$stmt->bindParam(':direccion',$direccion);
		$stmt->bindParam(':telefono',$telefono);
		
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: Error al actualizar el usuario ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
}

// Funcion actualizarPassword
function actualizarPassword($idUsuario,$password){
	
	$con = conectarBD();
	
	try{
		$sql = "UPDATE usuarios SET password=:password WHERE idUsuario=:idUsuario";
		$password = password_hash($password,PASSWORD_DEFAULT);
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idUsuario',$idUsuario);
		$stmt->bindParam(":password",$password);
		
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: Error al actualizar la password ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
}

// Funcion para borrarUsuario
function borrarUsuario($idUsuario){
	
	$con = conectarBD();
	
	try{
		$sql = "DELETE FROM usuarios WHERE idUsuario=:idUsuario";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idUsuario',$idUsuario);
		
		$stmt->execute();
		
	}catch(PDOException $e){
		echo "Error: Error al borrar el usuario".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $stmt->rowCount();
}


// Funcion seleccionarUsuario
function seleccionarUsuario($email){
	
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM usuarios WHERE email=:email";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':email',$email);
		
		$stmt->execute();
		
		$row = $stmt->fetch(PDO::FETCH_ASSOC); 
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar el usuario ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $row;
}

// Funcion SeleccionarTodosUsuarios
function seleccionarTodosUsuarios(){
	
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM usuarios";
		
		$stmt = $con->query($sql);
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e){
		echo "Error: Error seleccionar todos los usuarios ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

//Funcion seleccionarUsuarios
function seleccionarUsuarios($inicio,$usuariosPagina){
		
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM usuarios LIMIT :inicio,:usuariosPagina";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(":inicio",$inicio, PDO::PARAM_INT);// sacar un valor entero => PDO::PARAM_INT
		$stmt->bindParam(":usuariosPagina",$usuariosPagina, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar los usuarios".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

//-------------------------------------------------------------------------------------------------------------
//PEDIDOS
//-------------------------------------------------------------------------------------------------------------

// Funcion insertarPedido
function insertarPedido($idUsuario, $detallePedido, $total){
	
	$con = conectarBD();
	
	try{
		$con -> beginTransaction();
		$sql = "INSERT INTO pedidos(idUsuario, total) VALUES(:idUsuario, :total)";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(":idUsuario",$idUsuario);
		$stmt->bindParam(":total",$total);
		
		$stmt->execute();
		
		$idPedido = $con->lastInsertId();
		
		foreach($detallePedido as $idProducto => $cantidad){
			$producto = seleccionarProducto($idProducto);
			$precio = $producto["precioOferta"];
			
			$sql2 = "INSERT INTO detallepedido(idPedido, idProducto, cantidad, precio) VALUES(:idPedido, :idProducto, :cantidad, :precio)";
			
			$stmt = $con->prepare($sql2);
			
			$stmt->bindParam(":idPedido",$idPedido);
			$stmt->bindParam(":idProducto",$idProducto);
			$stmt->bindParam(":cantidad",$cantidad);
			$stmt->bindParam(":precio",$precio);
			
			$stmt->execute();
		}
		
		$con -> commit();
				
	}catch(PDOException $e){
		$con -> rollback();
		
		echo "Error: Error al insertar el pedido".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $idPedido;
}

// Funcion seleccionarTodosPedidos
function seleccionarTodosPedidos(){
	
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM pedidos";
		
		$stmt = $con->query($sql);
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e){
		echo "Error: Error seleccionar todos los pedidos ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

//Funcion seleccionarPedidos
function seleccionarPedidos($inicio,$pedidosPagina){
		
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM pedidos ORDER BY fecha DESC LIMIT :inicio,:pedidosPagina";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(":inicio",$inicio, PDO::PARAM_INT);// sacar un valor entero => PDO::PARAM_INT
		$stmt->bindParam(":pedidosPagina",$pedidosPagina, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar los pedidos".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

// Funcion seleccionarTodosPedidosUsuario
function seleccionarTodosPedidosUsuario($idUsuario){
	
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM pedidos WHERE idUsuario=:idUsuario";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(":idUsuario",$idUsuario, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e){
		echo "Error: Error seleccionar todos los pedidos ".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

// Funcion seleccionarPedidosUsuario
function seleccionarPedidosUsuario($idUsuario,$inicio,$pedidosPagina){
		
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM pedidos WHERE idUsuario=:idUsuario ORDER BY fecha DESC LIMIT :inicio,:pedidosPagina";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam("idUsuario",$idUsuario, PDO::PARAM_INT);
		$stmt->bindParam(":inicio",$inicio, PDO::PARAM_INT);// sacar un valor entero => PDO::PARAM_INT
		$stmt->bindParam(":pedidosPagina",$pedidosPagina, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar los pedidos".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}

function seleccionarDetallePedido($idPedido){
	
	$con = conectarBD();
	
	try{
		$sql = "SELECT * FROM detallepedido WHERE idPedido=:idPedido";
		
		$stmt = $con->prepare($sql);
		
		$stmt->bindParam(':idPedido',$idPedido, PDO::PARAM_INT);
		
		$stmt->execute();
		
		$rows = $stmt->fetchALL(PDO::FETCH_ASSOC); 
		
	}catch(PDOException $e){
		echo "Error: Error al seleccionar el pedido".$e->getMessage();
		
		file_put_contents("PDOErrors.txt", "\r\n".date('j F, Y, g:i a ').$e->getMessage(), FILE_APPEND);
		exit;
	}
	return $rows;
}
?>