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
		echo "<script type='text/javascript'>alert('La conexi\u00F3n con el servidor ha fallado');</script>";
		exit();	
	}
	mysqli_set_charset($conexion, 'utf8');
	if($ResultOne === "" && $ResultTwo === ""){
		$ResultOne = 0;
		$ResultTwo = 0;
	}else if($ResultOne === ""){
		$ResultOne = 0;
	}else if($ResultTwo === ""){
		$ResultTwo = 0;
	}

	$consulta = "INSERT INTO results(id_user , id_round , id_country_one, id_country_two, result_country_one, result_country_two) 
	VALUES('$IDUser', $IDRound, $IDCountryOne, $IDCountryTwo, $ResultOne, $ResultTwo)";

	$resultado = mysqli_query($conexion, $consulta);
	if($resultado){
			echo "<script type='text/javascript'>alert('Votaci\u00F3n realizada'); location.href = '../principal-pane.php'; </script>";
			exit();	
	}else{
		echo "<script type='text/javascript'>alert('No se pudo realizar la votaci\u00F3n'); location.href = '../principal-pane.php'; </script>";
	}
	mysqli_close($conexion);
?>