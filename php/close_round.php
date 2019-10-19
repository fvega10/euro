<?php
	require("conexion.php");
	$IDRound = $_GET["id_round_close"];
	
	$conexion = mysqli_connect($server, $user, $password, $database);
	
	if(mysqli_connect_errno()){
		echo "<script type='text/javascript'>alert('La conexion con el servidor ha fallado');</script>";
		exit();	
	}
	mysqli_set_charset($conexion, 'utf8');
	mysqli_autocommit($conexion, false);

	$consulta = 
	"SELECT * FROM results where id_round = $IDRound order by id_round";
	$resultado = mysqli_query($conexion, $consulta);
	if($resultado){
			$sql = "";
			$error = false;
			$cont5 = 0;
			$cont2 = 0;
			while($fila = mysqli_fetch_array($resultado)){
				if( (int)$fila[4] === (int)$fila[6] && (int)$fila[5] === (int)$fila[7] )
				{
					$sql = "UPDATE users SET puntuation = puntuation + 5 WHERE email = '$fila[0]';";
					$query = mysqli_query($conexion, $sql); 
					if(!$query){
						$error = true;
						break;
					}else{
						$cont5++;
					}
				}else{
					if( (int)$fila[4] > (int)$fila[5] && (int)$fila[6] > (int)$fila[7] ){
						$sql = "UPDATE users SET puntuation = puntuation + 2 WHERE email = '$fila[0]';";
						$query = mysqli_query($conexion, $sql); 
						if(!$query){
							$error = true;
							break;
						}else{
							$cont2++;
						}
					}
					else if( (int)$fila[4] < (int)$fila[5] && (int)$fila[6] < (int)$fila[7] ){
						$sql = "UPDATE users SET puntuation = puntuation + 2 WHERE email = '$fila[0]';";
						$query = mysqli_query($conexion, $sql); 
						if(!$query){
							$error = true;
							break;
						}else{
							$cont2++;
						}
					}else if( (int)$fila[4] === (int)$fila[5] && (int)$fila[6] === (int)$fila[7] ){
						$sql = "UPDATE users SET puntuation = puntuation + 2 WHERE email = '$fila[0]';";
						$query = mysqli_query($conexion, $sql); 
						if(!$query){
							$error = true;
							break;
						}else{
							$cont2++;
						}
					}
				}
				
			}
			if(!$error){
				$sql2 = "UPDATE round set is_active = false where id = $IDRound";
				$queryTwo = mysqli_query($conexion, $sql2); 
				if($queryTwo){

					mysqli_commit($conexion);
					echo "<script type='text/javascript'>alert('Ronda cerrada satisfactoriamente. De 5: $cont5. De 2: $cont2'); location.href = '../administrator.php'; </script>";
				}else{
					mysqli_rollback($conexion);
					echo "<script type='text/javascript'>alert('La ronda se cerro con errores: $queryTwo'); location.href = '../administrator.php'; </script>";
				}
				
			}else{
				mysqli_rollback($conexion);
				echo "<script type='text/javascript'>alert('La ronda se cerro con errores: $query'); location.href = '../administrator.php'; </script>";
			}
	}else{
		mysqli_rollback($conexion);
		echo "<script type='text/javascript'>alert('Ocurrio un error inesperado: $resultado'); location.href = '../administrator.php'; </script>";
	}
	mysqli_close($conexion);
?>