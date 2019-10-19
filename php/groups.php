<?php
	class group{
		private $DataAccess;
		private $v = 'error';
		public function __construct(){
			require_once('DataAccess.php');
			$this->DataAccess = new DataAccess();
		}

		function GetGroups(){
			$sql = "SELECT * FROM groups";
			$data = $this->DataAccess->ExecuteSQLGet($sql);
			if($this->DataAccess->IsError())
			{
				$data[0] = $v;
			}
			return $data;
		}
		function GetCountryGroups($IdGroup){
			$sql = "SELECT cr.*, c.description, c.name_id
					FROM country_group cr, country c
					WHERE 
					cr.id_country = c.id AND 
					cr.id_groups = $IdGroup 
					order by puntos desc";

			$data = $this->DataAccess->ExecuteSQLGet($sql);
			if($this->DataAccess->IsError())
			{
				$data[0] = $v;
			}
			return $data;
		}

		function GetResults($username){
			$sql = "SELECT r.id_round, r.id_country_one, c.description, 
					r.result_country_one, r.correct_result_country_one, 
					r.id_country_two, t.description, r.result_country_two, r.correct_result_country_two
					from results r, country c, country t 
					WHERE r.id_country_one = c.id AND 
					r.id_country_two = t.id AND 
					r.id_user = '$username' AND r.can_modified = false";
					
			$data = $this->DataAccess->ExecuteSQLGet($sql);
			if($this->DataAccess->IsError())
			{
				$data[0] = $v;
			}
			return $data;
		}
	}

?>