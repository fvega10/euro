<?php
	class user{
		private $conexion;
		private $error = false;
		private $errorMessage = "";

		public function __construct(){
			require_once('conexion.php');
			$this->conexion = new conexion();
			$this->conexion->connected();
		}

		function IsError(){
			return $this->error;
		}
		function ErrorMessage(){
			return $this->errorMessage;
		}

		function ClearErrors(){
			$this->error = false;
			$this->errorMessage = "";
		}

		function identify($email, $password)
		{
			$sql = "SELECT * FROM users WHERE email = '$email' AND password = md5('$password')";
			$result = $this->conexion->conexion->query($sql);
			
			if($result->num_rows > 0)
			{
				$data = $result->fetch_array();
			}
			else
			{
				$data[0] = 0;
			}
			return $data;
			$this->conexion->close_conexion();
		}

		function InsertUser($email, $name, $password)
		{
			$this->ClearErrors();
			$sql    = "SELECT count(*) FROM users WHERE email = '$email'";
			$this->conexion->conexion->set_charset('utf8');
			$result = $this->conexion->conexion->query($sql);
			$r = $result->fetch_array();

			if((int)$r[0] === 0)
			{
				$sql = "INSERT INTO users (email, user_name, password) VALUES('$email', '$name', md5('$password'))";
				if($this->conexion->conexion->query($sql))
				{
					$this->error = false;
					$this->errorMessage = "exito";
					return false;
				}
				else
				{
					$this->error = true;
					$this->errorMessage = "error";
					return true;
				}
			}else{
				$this->error = true;
				$this->errorMessage = "aviso";
				return true;
			}
			$this->conexion->close_conexion();
		}

		function getUsers()
		{
			$sql = "SELECT email, puntuation, user_name FROM users order by puntuation desc";
			$this->conexion->conexion->set_charset('utf8');
			$result = $this->conexion->conexion->query($sql);
			$data = array();
			if($result->num_rows > 0)
			{
				while($re = $result->fetch_array(MYSQL_NUM)){
					$data[] = $re;
				}
			}
			else
			{
				$data[0] = '0';
			}
			return $data;
			$this->conexion->close_conexion();
		}
	}
?>