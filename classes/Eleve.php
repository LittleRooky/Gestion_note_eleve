<?php
	/**
	* 
	*/
	include("Utilisateur.php");
	class Eleve extends Utilisateur
	{
		private $classe;
		
		function __construct($pseudo,
																			$nom,
																			$prenom,
																			$sexe,
																			$password,
																			$classe)
		{
			parent::__construct($pseudo,
																			$nom,
																			$prenom,
																			$sexe,
																			$password);
			$this->classe = $classe;
		}

		public function setClasse($classe)
		{
			$this->classe = $classe;
		}

		public function getClasse()
		{
			return $this->classe;
		}
	}
?>