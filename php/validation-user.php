<?php

	require("conexion.php");
	$Email = $_POST['email'];
	$pass = $_POST['password'];
	settype($pass, 'string');

	if($Email === "" ||
		$pass === ""){
		echo "<script type='text/javascript'>alert('Debe completar todos los campos'); location.href = '../new-user.php'; </script>";
		exit();	
	}

	$conexion = mysqli_connect($server, $user, $password, $database);
	if(mysqli_connect_errno()){
		echo "<script type='text/javascript'>alert('La conexion con el servidor ha fallado');</script>";
		exit();	
	}
	mysqli_set_charset($conexion, 'utf8');
	$consulta = "SELECT email, user_name FROM users WHERE email = '$Email' AND password = md5('$pass')";
	$resultado = mysqli_query($conexion, $consulta);
	
	if($resultado){

		$value = mysqli_fetch_row($resultado);
		$x = $resultado->num_rows;
		if($x == 0){
			echo "<script type='text/javascript'>alert('Usuario y/o contrase\u00F1a incorrectos'); location.href = '../index.php'; </script>";
			exit();	
		}else{
			session_start(); 
		     //Guardamos dos variables de sesión que nos auxiliará para saber si se está o no "logueado" un usuario 
		      
      		$_SESSION["autentica"] = "SIP"; 
	      	$_SESSION["usuarioactual"] = $value[0]; 
		    $_SESSION['usuarioname'] = $value[1];   

		      //nombre del usuario logueado. 
		      //Direccionamos a nuestra página principal del sistema. 
			echo "<script type='text/javascript'>location.href = '../principal-pane.php'; </script>";
		}
	}else{
		echo "<script type='text/javascript'>alert('Ocurrió un error inesperado'); location.href = '../index.php'; </script>";
	}
	mysqli_close($conexion);
?>