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
		$sql = "SELECT * FROM productos LIMIT :numOfertas";
		
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
		$sql = "SELECT * FROM productos";
		
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
?>