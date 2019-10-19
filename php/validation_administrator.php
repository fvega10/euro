<?php
	require("conexion.php");
	$pass = $_POST['password'];

	if($pass === ""){
		echo "<script type='text/javascript'>alert('Debe completar todos los campos'); location.href = '../new-user.php'; </script>";
		exit();	
	}

	$conexion = mysqli_connect($server, $user, $password, $database);
	if(mysqli_connect_errno()){
		echo "<script type='text/javascript'>alert('La conexi\u00F3n con el servidor ha fallado');</script>";
		exit();	
	}
	mysqli_set_charset($conexion, 'utf8');
	$consulta = "SELECT email FROM users WHERE email = 'fabriciovu@gmail.com' AND password = md5('$pass')";
	$resultado = mysqli_query($conexion, $consulta);
	
	if($resultado){

		$value = mysqli_fetch_row($resultado);
		$x = $resultado->num_rows;
		if($x == 0){
			echo "<script type='text/javascript'>alert('Usuario y/o contrase\u00F1a incorrectos'); location.href = '../administrator_singin.php'; </script>";
			exit();	
		}else{
			session_start(); 
		     //Guardamos dos variables de sesión que nos auxiliará para saber si se está o no "logueado" un usuario 
		      
      		$_SESSION["aut"] = "SIP"; 
	      	$_SESSION["userAdministrator"] = $value[0]; 
		       
		      //nombre del usuario logueado. 
		      //Direccionamos a nuestra página principal del sistema. 
			echo "<script type='text/javascript'>location.href = '../administrator.php'; </script>";
		}
	}else{
		echo "<script type='text/javascript'>alert('No se pudo agregar el registro'); location.href = '../administrator_singin.php'; </script>";
	}
	mysqli_close($conexion);
?>