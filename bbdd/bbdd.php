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

?>