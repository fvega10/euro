<?php
	require("conexion.php");
	$IDUser = $_GET["id_username"];
	$IDRound = $_GET["id_round"];
	$IDCountryOne = $_GET["id_country_one"];
	$IDCountryTwo = $_GET["id_country_two"];
	$ResultOne = $_GET['country_one'];
	$ResultTwo = $_GET['country_two'];
	
	$conexion = mysqli_connect($server, $user, $password, $database);
	if(mysqli_connect_errno()){
		echo "<script type='text/javascript'>alert('La conexion con el servidor ha fallado');</script>";
		exit();	
	}
	mysqli_set_charset($conexion, 'utf8');

	$consulta = 
	"UPDATE results set result_country_one = $ResultOne, result_country_two = $ResultTwo 
	WHERE id_user = '$IDUser' AND id_round = $IDRound AND id_country_one = $IDCountryOne AND id_country_two = $IDCountryTwo";

	$resultado = mysqli_query($conexion, $consulta);
	if($resultado){
			echo "<script type='text/javascript'>alert('Votaci\u00F3n modificada satisfactoriamente');'; </script>";
			exit();	
	}else{
		echo "<script type='text/javascript'>alert('No se pudo modificar la votaci\u00F3n'); location.href = '../principal-pane.php'; </script>";
	}
	mysqli_close($conexion);
?>