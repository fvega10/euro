<?php
	require("conexion.php");
	$IDRound = $_GET["id_round"];
	$IDCountryOne = $_GET["id_country_one"];
	$IDCountryTwo = $_GET["id_country_two"];
	$ResultOne = $_GET['country_one'];
	$ResultTwo = $_GET['country_two'];

	$ganePrimero     = 0;
	$empatePrimero   = 0;
	$perdidaPrimero  = 0;

	$ganeSegundo     = 0;
	$empateSegundo   = 0;
	$perdidaSegundo  = 0;

	$puntosPrimer    = 0;
	$puntosSegundo   = 0;

	if( (int)$ResultOne > (int)$ResultTwo ){
		$puntosPrimer   = 3;
		$ganePrimero    = 1;
		$perdidaSegundo = 1;
	}
	else if( (int)$ResultOne < (int)$ResultTwo ){
		$puntosSegundo   = 3;
		$perdidaPrimero  = 1;
		$ganeSegundo     = 1;

	}else{
		$puntosPrimer   = 1;
		$puntosSegundo   = 1;
		$empatePrimero   = 1;
		$empateSegundo   = 1;
	}
	
	$conexion = mysqli_connect($server, $user, $password, $database);

	if(mysqli_connect_errno()){
		echo "<script type='text/javascript'>alert('La conexi\u00F3n con el servidor ha fallado');</script>";
		exit();	
	}
	mysqli_set_charset($conexion, 'utf8');
	mysqli_autocommit($conexion, false);

	$consulta = "UPDATE results set correct_result_country_one = $ResultOne, correct_result_country_two = $ResultTwo  
	WHERE id_round = $IDRound AND id_country_one = $IDCountryOne AND id_country_two =  $IDCountryTwo";
	$resultado = mysqli_query($conexion, $consulta);
	
	if($resultado){
		$consultaTwo = "UPDATE country_group SET pj = pj + 1, g = g + $ganePrimero, e = e + $empatePrimero, p = p + $perdidaPrimero, 
		gf = gf + $ResultOne, gc = gc + $ResultTwo, puntos = puntos + $puntosPrimer where id_country = $IDCountryOne";
		$resultadoTwo = mysqli_query($conexion, $consultaTwo);

		$consultaThree = "UPDATE country_group SET pj = pj + 1, g = g + $ganeSegundo, e = e + $empateSegundo, p = p + $perdidaSegundo, 
		gf = gf + $ResultTwo, gc = gc + $ResultOne, puntos = puntos + $puntosSegundo where id_country = $IDCountryTwo";
		$resultadoThree = mysqli_query($conexion, $consultaThree);
		
		if($resultadoTwo && $resultadoThree){
			mysqli_commit($conexion);
			echo "<script type='text/javascript'>alert('Votaci\u00F3n realizada'); location.href = '../administrator.php'; </script>";
		}else{
			mysqli_rollback($conexion);
			echo "<script type='text/javascript'>alert('No se pudo realizar la votaci\u00F3n'); location.href = '../administrator.php'; </script>";
		}
	}else{
		mysqli_rollback($conexion);
		echo "<script type='text/javascript'>alert('No se pudo realizar la votaci\u00F3n'); location.href = '../administrator.php'; </script>";
	}
	mysqli_close($conexion);
?>