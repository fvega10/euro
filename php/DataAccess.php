<?php

	class DataAccess{

		private $conexion;
		private $error = false;
		private $errorMessage = "";

		public function __construct(){
			require_once('conexion.php');
			$this->conexion = new conexion();
			$this->conexion->connected();
		}

		function IsError()
		{
			return $this->error;
		}
		function ErrorMessage()
		{
			return $this->errorMessage;
		}

		function ClearErrors()
		{
			$this->error = false;
			$this->errorMessage = "";
		}

		function ExecuteSQLGet($sql)
		{
			$this->ClearErrors();
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
				$this->error = true;
				$this->errorMessage = "error";
				$data[0] = 'error';
			}
			return $data;
			$this->conexion->close_conexion();
		}

		function ExecuteSQL($sql)
		{
			$this->ClearErrors();
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
			$this->conexion->close_conexion();
		}
	}
?>