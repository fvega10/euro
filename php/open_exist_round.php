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
	"UPDATE country_round set can_vote = true 
	WHERE id_round = $IDRound AND id_country_one = $IDCountry1 AND id_country_two = $IDCountry2";

	$resultado = mysqli_query($conexion, $consulta);
	if($resultado){
		$exist = "SELECT count(*) from round where is_active = true";
		$r1 = mysqli_query($conexion, $exist);
		if($r1){
			$row = mysqli_fetch_array($r1);
			if($row[0] === "0"){
				$save = 
				"UPDATE round set is_active = true 
				WHERE id = $IDRound AND id_country_one = $IDCountry1 AND id_country_two = $IDCountry2";
				$r2 = mysqli_query($conexion, $r2);
				if($r2){
					mysqli_commit($conexion);
					echo "<script type='text/javascript'>alert('Votaci\u00F3n abierta satisfactoriamente'); location.href = '../administrator.php'; </script>";
				}else{
					mysqli_rollback($conexion);
					echo "<script type='text/javascript'>alert('No se pudo abrir la votaci\u00F3n'); location.href = '../administrator.php'; </script>";
				}
				
			}else{
				mysqli_rollback($conexion);
				echo "<script type='text/javascript'>alert('No se puede abrir ya que actualmente existe un ronda abierta'); location.href = '../administrator.php'; </script>";
			}
		}else{
			mysqli_rollback($conexion);
			echo "<script type='text/javascript'>alert('No se pudo abrir la votaci\u00F3n'); location.href = '../administrator.php'; </script>";
		}
	}else{
		mysqli_rollback($conexion);
		echo "<script type='text/javascript'>alert('No se pudo abierta la votaci\u00F3n'); location.href = '../administrator.php'; </script>";
	}
	mysqli_close($conexion);
?>