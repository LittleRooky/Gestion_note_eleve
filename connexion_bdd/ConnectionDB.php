<?php
	class ConnectionDB
	{
		// ATTRIBUTS
		private $db;
		private $sgdbr;
		private $host;
		private $dbname;
		private $user;
		private $password;

		public function __construct()
		{
			$this->sgdbr = 'mysql';
			$this->host = 'localhost';
			$this->dbname = 'gestion_notes_eleves';
			$this->user = 'root';
			$this->password = 'root';

			try
			{
				$this->db = new PDO("{$this->getSGDBR()}:host={$this->getHost()};
				  	dbname={$this->getDBName()}",
				$this->getUser(),
				$this->getPassword(),
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			}
			catch (PDO_Exception $e)
			{
				echo $e->getMessage();
			}
		}

		public function getDB()
		{
			return $this->db;
		}

		public function getSGDBR()
		{
			return $this->sgdbr;
		}

		public function getHost()
		{
			return $this->host;
		}

		public function getDBName()
		{
		return $this->dbname;
		}

		public function getUser()
		{
		return $this->user;
		}

		public function getPassword()
		{
		return $this->password;
		}
	}
?>