<?php
	require("conexion.php");
	$Email = $_POST['email'];
	$pass = $_POST['password'];
	$repass = $_POST['repassword'];
	$newUserName = $_POST["userNombre"];

	if($Email === "" ||
		$pass === ""){
		echo "<script type='text/javascript'>alert('Debe completar todos los campos'); location.href = '../new-user.php'; </script>";
		exit();	
	}
	if($pass != $repass){
		echo "<script type='text/javascript'>alert('Las contrase\u00F1as debe de ser iguales'); location.href = '../new-user.php'; </script>";
		exit();	
	}

	$conexion = mysqli_connect($server, $user, $password, $database);
	if(mysqli_connect_errno()){
		echo "<script type='text/javascript'>alert('La conexion con el servidor ha fallado');</script>";
		exit();	
	}
	mysqli_set_charset($conexion, 'utf8');
	mysqli_autocommit($conexion, false);
	$consulta = "SELECT count(*) FROM users WHERE email = '$Email'";
	$resultado = mysqli_query($conexion, $consulta);
	
	if($resultado){

		$value = mysqli_fetch_row($resultado);
		$x = $value[0];
		if($x === "0"){
			$consulta = "INSERT INTO users (email, password, user_name) VALUES('$Email', md5('$pass'), '$newUserName')";
			$resultado = mysqli_query($conexion, $consulta);
			if($resultado){
				if(mysqli_affected_rows($conexion)==0){
					echo "<script type='text/javascript'>alert('No se pudo agregar el registro'); location.href = '../new-user.php'; </script>";
				}else{
					mysqli_commit($conexion);
					echo "<script type='text/javascript'>alert('Usuario agregado exitosamente'); location.href = '../index.php'; </script>";
				}
			}else{
				mysqli_rollback($conexion);
				echo "<script type='text/javascript'>alert('No se pudo agregar el registro'); location.href = '../new-user.php'; </script>";
			}
		}else{
			mysqli_commit($conexion);
			echo "<script type='text/javascript'>alert('Ya existe un usuario con el mismo correo electr\u00F3nico'); location.href = '../new-user.php'; </script>";
		}
	}else{
		mysqli_rollback($conexion);
		echo "<script type='text/javascript'>alert('No se pudo agregar el registro'); location.href = '../new-user.php'; </script>";
	}
	mysqli_close($conexion);
?>