<?php
	/**
	* 
	*/
	include ("Utilisateur.php");
	class Employe extends Utilisateur
	{
		private $poste;
		
		function __construct($pseudo,
						 	 $nom,
							 $prenom,
							 $sexe,
							 $password,
							 $poste)
		{
			parent::__construct($pseudo,
								$nom,
								$prenom,
								$sexe,
								$password);

			$this->poste = $poste;
		}

		public function setPoste($poste)
		{
			$this->poste = $poste;
		}

		public function getPoste()
		{
			return $this->poste;
		}
	}
?>