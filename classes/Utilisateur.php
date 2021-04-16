<?php
	/**
	* 
	*/
	abstract class Utilisateur
	{
		private $pseudo;
		private $nom;
		private $prenom;
		private $sexe;
		private $password;
		
		function __construct($pseudo,
																			$nom,
																			$prenom,
																			$sexe,
																			$password)
		{
			$this->pseudo = $pseudo;
			$this->nom = $nom;
			$this->prenom = $prenom;
			$this->sexe = $sexe;
			$this->password = $password;
		}

		public function setPseudo($pseudo)
		{
			$this->pseudo = $pseudo;
		}

		public function setNom($nom)
		{
			$this->nom = $nom;
		}

		public function setPrenom($prenom)
		{
			$this->prenom = $prenom;
		}

		public function setSexe($sexe)
		{
			$this->sexe = $sexe;
		}

		public function setPassword($password)
		{
			$this->password = $password;
		}

		public function getPseudo()
		{
			return $this->pseudo;
		}

		public function getNom()
		{
			return $this->nom;
		}

		public function getPrenom()
		{
			return $this->prenom;
		}

		public function getSexe()
		{
			return $this->sexe;
		}

		public function getPassword()
		{
			return $this->password;
		}
	}
?>