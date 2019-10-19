<?php
	require("conexion.php");
	$IDRound = $_GET["id_round"];
	$IDCountryOne = $_GET["id_country_one"];
	$IDCountryTwo = $_GET["id_country_two"];
	$ResultOne = $_GET['country_one'];
	$ResultTwo = $_GET['country_two'];
	$OldResultTwo = $_GET['oldResult_country_one'];
	$OldResultTwo = $_GET['oldResult_country_two'];

	$conexion = mysqli_connect($server, $user, $password, $database);
	if(mysqli_connect_errno()){
		echo "<script type='text/javascript'>alert('La conexi\u00F3n con el servidor ha fallado');</script>";
		exit();	
	}
	mysqli_set_charset($conexion, 'utf8');

	$consulta = "UPDATE results set correct_result_country_one = $ResultOne, correct_result_country_two = $ResultTwo  
	WHERE id_round = $IDRound AND id_country_one = $IDCountryOne AND id_country_two =  $IDCountryTwo";

	$resultado = mysqli_query($conexion, $consulta);
	if($resultado){
			echo "<script type='text/javascript'>alert('Votaci\u00F3n modificada satisfactoriamente'); location.href = '../administrator.php'; </script>";
			exit();	
	}else{
		echo "<script type='text/javascript'>alert('No se pudo modificar la votaci\u00F3n'); location.href = '../administrator.php'; </script>";
	}
	mysqli_close($conexion);
?>