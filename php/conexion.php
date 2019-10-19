<?php
	class conexion{
		private $server;
		private $user;
		private $password;
		private $database;
		public $conexion;

		public function __construct(){
			$this->server = "localhost";
			$this->user = "root";
			$this->password = "";
			$this->database = "eurocopa";
		}

		function connected(){
			$this->conexion = new mysqli($this->server, $this->user, $this->password, $this->database);
		}

		function close_conexion(){
			$this->conexion->close();
		}

	}
?>