<?php
	class round{
		private $DataAccess;
		private $error;
		private $errorMensaje;
		private $v = 'error';


		public function __construct(){
			require_once('DataAccess.php');
			$this->DataAccess = new DataAccess();
		}

		function GetRounds()
		{
			$sql = "SELECT * FROM round order by id";
			$data = $this->DataAccess->ExecuteSQLGet($sql);
			if($this->DataAccess->IsError())
			{
				$data[0] = $v;
			}
			return $data;
		}

		function GetRoundActive()
		{
			$sql = "SELECT id, description, fecha  FROM round WHERE is_active = true";
			$data = $this->DataAccess->ExecuteSQLGet($sql);
			if($this->DataAccess->IsError())
			{
				$data[0] = $v;
			}
			return $data;
		}

		function GetCountryRound($idRound)
		{
			$sql = "SELECT cr.*, c.description, c2.description 
		    		FROM country_round cr, country c, country c2 
		    		WHERE 
		    		cr.id_round       = $idRound AND
		    		cr.id_country_one = c.id AND 
		    		cr.id_country_two = c2.id";
			$data = $this->DataAccess->ExecuteSQLGet($sql);
			if($this->DataAccess->IsError())
			{
				$data[0] = $v;
			}
			return $data;
		}

		function GetResults($Username, $idRound, $CountrOne, $CountryTwo)
		{
			$sql = "SELECT result_country_one, result_country_two 
					FROM results 
					WHERE id_user = '$Username' AND 
					id_round = $idRound AND 
					id_country_one = $CountrOne AND 
					id_country_two = $CountryTwo";
			$data = $this->DataAccess->ExecuteSQLGet($sql);
			if($this->DataAccess->IsError())
			{
				$data[0] = $v;
			}
			return $data;
		}
	}
?>