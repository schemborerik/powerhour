<?php
	/******************************************************************************************
	//	"dbwrapper.php"
	//	Wrapper class for mysql functions
	//
	*******************************************************************************************/
	class Db {
		protected static $conn;
		
		public function connect() {
		
			if(!isset($conn)) {
				$config = parse_ini_file('config.ini');
				self::$conn = new mysqli($config['host'], $config['username'], $config['password'], $config['dbname']);
			}
			
			if (self::$conn === false) {
				return false;
			}
			
			return self::$conn;
		}
		
		public function query($query) {
			$conn = $this -> connect();
			
			$result = $conn -> query($query);
			
			
			return $result;
		}
		
		public function select($query) {
			$rows = array();
			$result = $this -> query($query);
			if($result === false) {
				return false;
			}
			while($row = $result -> fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
		
		public function select_one($query) {
			$result = $this -> query($query);
			if($result === false) {
				return false;
			}
			$row = $result -> fetch_assoc();
			return $row;
		}
		
		public function affected_rows() {
			return self::$conn -> affected_rows;
		}
		
		public function transaction($query_list) {
			try {
				$conn = $this -> connect();
				$conn -> autocommit(FALSE);
				
				$results = array();
				foreach($query_list as $query) {
					$res = $conn -> query($query);
					if($res === false)
						throw new Exception('Wrong SQL: ' . $query . 'Error: ' . $conn -> error);
					$results[] = $res;
				}
				$conn -> commit();
			} catch(Exception $e) {
				$conn -> rollback();
			}
			$conn -> autocommit(TRUE);			
			return $results;
		}
		
		public function error() {
			$conn = $this -> connect();
			return $conn -> error;
		}
		
		public function quote($value) {
			$conn = $this -> connect();
			return "'" . $conn -> real_escape_string($value) . "'";
		}
	}
?>