<?php
	require("conexion.php");
	$IDUser = $_GET["correo"];
	$IDName = $_GET["nombreUsuario"];
	
	$conexion = mysqli_connect($server, $user, $password, $database);
	if(mysqli_connect_errno()){
		echo "<script type='text/javascript'>alert('La conexi\u00F3n con el servidor ha fallado');</script>";
		exit();	
	}
	mysqli_set_charset($conexion, 'utf8');

	$consulta = "UPDATE users SET user_name = '$IDName' WHERE email = '$IDUser'";

	$resultado = mysqli_query($conexion, $consulta);
	if($resultado){
			echo "<script type='text/javascript'>alert('Usuario modificado satisfactoriamente'); location.href = '../principal-pane.php'; </script>";
	}else{
		echo "<script type='text/javascript'>location.href = '../principal-pane.php'; </script>";
	}
	mysqli_close($conexion);
?>