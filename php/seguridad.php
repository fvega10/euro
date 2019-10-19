<?php 
	//Reanudamos la sesión 
	@session_start(); 
	//Validamos si existe realmente una sesión activa o no 
	if($_SESSION["autentica"] != "SIP")
	{ 
	  	//Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión) 
	  	echo "<script type='text/javascript'>alert('Para ver el contenido debe de iniciar sesion'); location.href = 'index.php' </script>";
	  	exit(); 
	}
?>