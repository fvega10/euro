<?php 
	//Reanudamos la sesión 
	@session_start(); 
	//Validamos si existe realmente una sesión activa o no 
	if($_SESSION["aut"] != "SIP")
	{ 
	  	//Si no hay sesión activa, lo direccionamos al index.php (inicio de sesión) 
	  	echo "<script type='text/javascript'>alert('Para ver el contenido debe de iniciar sesi\u00F3n'); location.href = 'administrator_singin.php' </script>";
	  	exit(); 
	}
?>