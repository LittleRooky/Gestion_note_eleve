<?php
	/**
	* 
	*/
	class Matiere
	{
		private $id;
		private $nom;
		private $annee;
		private $coefficient;

		function __construct($id,
							 $nom,
							 $annee,
							 $coefficient)
		{
			$this->id = $id;
			$this->nom = $nom;
			$this->annee = $annee;
			$this->coefficient = $coefficient;
		}

		public function setId($id)
		{
			$this->id = $id;
		}

		public function setNom($nom)
		{
			$this->nom = $nom;
		}

		public function setAnnee($annee)
		{
			$this->annee = $annee;
		}

		public function setCoefficient($coefficient)
		{
			$this->coefficient = $coefficient;
		}

		public function getId()
		{
			return $this->id;
		}

		public function getNom()
		{
			return $this->nom;
		}

		public function getAnnee()
		{
			return $this->annee;
		}

		public function getCoefficient()
		{
			return $this->coefficient;
		}
	}
?>