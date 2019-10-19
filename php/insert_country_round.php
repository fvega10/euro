<?php
	require("conexion.php");
	$Round       = $_GET['ronda'];
	$Country1    = $_GET['pais1'];
	$Country2    = $_GET['pais2'];
	$Description = $_GET['descripcion_ronda'];
	$Stadium     = $_GET['estadio'];
	$Hora        = $_GET['hora'];

	$conexion = mysqli_connect($server, $user, $password, $database);
	if(mysqli_connect_errno()){
		echo "<script type='text/javascript'>alert('La conexion con el servidor ha fallado');</script>";
		exit();	
	}

	mysqli_set_charset($conexion, 'utf8');

	$c = "INSERT INTO country_round (id_round, id_country_one, id_country_two, description, stadium, hora) 
	VALUES ($Round, $Country1, $Country2, '$Description', '$Stadium', '$Hora');";
	
	$r = mysqli_query($conexion, $c);

	if($r){
		echo "<script type='text/javascript'>alert('Registro agregado satisfactoriamente'); location.href = '../administrator.php'; </script>";
	}else{
		
		echo "<script type='text/javascript'>alert('No se pudo agregar el registro: $r'); location.href = '../administrator.php'; </script>";
	}
	mysqli_close($conexion);
?>