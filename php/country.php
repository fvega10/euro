<?php
	require("conexion.php");
	$Name = $_GET['pais'];

	if($Name === "" ){
		echo "<script type='text/javascript'>alert('Debe completar todos los campos'); location.href = '../administrator.php'; </script>";
		exit();	
	}
	
	$conexion = mysqli_connect($server, $user, $password, $database);
	if(mysqli_connect_errno()){
		echo "<script type='text/javascript'>alert('La conexion con el servidor ha fallado');</script>";
		exit();	
	}
	mysqli_set_charset($conexion, 'utf8');

	$consulta = "INSERT INTO country(description) VALUES('$Name')";

	$resultado = mysqli_query($conexion, $consulta);
	if($resultado){
		echo "<script type='text/javascript'>alert('Registro agregado satisfactoriamente'); location.href = '../administrator.php'; </script>";
	}else{
		mysqli_rollback($conexion);
		echo "<script type='text/javascript'>alert('No se pudo agregar el registro'); location.href = '../administrator.php'; </script>";
	}
	mysqli_close($conexion);
?>