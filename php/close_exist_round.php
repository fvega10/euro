<?php
	require("conexion.php");
	$IDRound = $_GET["roundID"];
	$IDCountry1 = $_GET["country1"];
	$IDCountry2 = $_GET["country2"];
	$conexion = mysqli_connect($server, $user, $password, $database);
	if(mysqli_connect_errno()){
		echo "<script type='text/javascript'>alert('La conexion con el servidor ha fallado');</script>";
		exit();	
	}

	mysqli_set_charset($conexion, 'utf8');
	mysqli_autocommit($conexion, false);

	$consulta = 
	"UPDATE country_round set can_vote = false 
	WHERE id_round = $IDRound AND id_country_one = $IDCountry1 AND id_country_two = $IDCountry2";

	$resultado = mysqli_query($conexion, $consulta);
	if($resultado){

		$consultaTwo = 
		"UPDATE results set can_modified = false where id_round = $IDRound AND id_country_one = $IDCountry1 AND id_country_two = $IDCountry2;";
		$resultadoTwo = mysqli_query($conexion, $consultaTwo);

		if($resultadoTwo){
			mysqli_commit($conexion);
			echo "<script type='text/javascript'>alert('Votaci\u00F3n cerrada satisfactoriamente'); location.href = '../administrator.php'; </script>";
		}else{
			mysqli_rollback($conexion);
			echo "<script type='text/javascript'>alert('No se pudo cerrada la votaci\u00F3n'); location.href = '../administrator.php'; </script>";
		}
	}else{
		mysqli_rollback($conexion);
		echo "<script type='text/javascript'>alert('No se pudo cerrada la votaci\u00F3n'); location.href = '../administrator.php'; </script>";
	}
	mysqli_close($conexion);
?>