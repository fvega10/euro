<?php
	require_once('../php/user.php');
	$action = $_POST['button'];

	switch($action){
		case 'close':
			session_start();
			session_destroy();
			break;

		case 'singin':
			$email    = $_POST['email'];
			$password = $_POST['password'];

			$instance = new user();
			$array    = $instance->identify($email, $password);
			
			if($array[0] === 0){
				echo "incorrecto";
			}
			else
			{
				session_start(); 
			    $_SESSION["autentica"]     = "SIP"; 
		      	$_SESSION["usuarioactual"] = $array[0]; 
			    $_SESSION['usuarioname']   = $array[1];   
			    $_SESSION['points']        = $array[2];   
				echo "Bienvenido";
			}
			break;

		case 'insert':
			$email    = $_POST['email'];
			$name     = $_POST['name'];
			$password = $_POST['password'];

			$instance = new user();
			if(!$instance->InsertUser($email, $name, $password))
			{
				echo "exito";
			}
			else
			{
				echo $instance->ErrorMessage();
			}
			break;
	}
?>