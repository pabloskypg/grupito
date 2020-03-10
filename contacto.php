<?php session_start(); ?>
<?php require_once("bbdd/bbdd.php"); ?>
<?php $pagina = "contacto";
	  $titulo = "Contacta con nosotros"; ?>
<?php require_once("inc/encabezado.php"); ?>
<?php require_once("inc/funciones.php"); ?>

<main role="main">
  <!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="display-3">Contacto</h1>
    </div>
  </div>
  <?php 
  function imprimirFormulario(){
	?>
  <div class="container">
	  <form method="post">
		<div class="form-group">
			<label for="nombre">Tu email</label>
			<input type="text" class="form-control" id="mail" name="email" value="<?php if (isset($_SESSION["email"])){echo $_SESSION["email"]; }?>"/>
		</div>
		<div class="form-group">
			<label for="asunto">Asunto</label>
			<input type="text" class="form-control" id="asunto" name="asunto"/>
		</div>
		<div class="form-group">
		<label for="mensaje">Texto</label>
			<textarea rows="10" class="form-control" id="mensaje" name="mensaje"></textarea>
		</div>
		<p><input type="submit" class="btn btn-primary btn-lg" id="enviar" name="enviar"/></p>
	</form>
  </div>
  <?php
  }
  if (empty($_POST)){
	  imprimirFormulario();
	  if (isset($_SESSION["contacto"]) and $_SESSION["contacto"]==true){
		  echo "<div class='container'><b>El correo ha sido enviado correctamente</b></div>";
		  unset($_SESSION["contacto"]);
	  }
  }else{
	  $email = recoge("email");
	  $mensaje = recoge("mensaje");
	  $asunto = recoge("asunto");
	  
	  $errores = "";
	  
	  if ($email == ""){
		  $errores = $errores."<li>Escribe tu email</li>";
	  }
	  if ($mensaje == ""){
		  $errores = $errores."<li>Escribe el mensaje a enviar</li>";
	  }
	  
	  if ($errores != ""){
		  echo "<ul>$errores</ul>";
		  imprimirFormulario();
	  }else{
		$_SESSION["emailContacto"] = $email;
		$_SESSION["mensaje"] = $mensaje;
		$_SESSION["asunto"] = $asunto;
		header("Location:enviarMail.php");
	  }
  }	  
  ?>
  
  
  
</main>
<?php require_once("inc/pie.php"); ?>