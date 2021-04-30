<?php
	/**
	* 
	*/
	include ("Utilisateur.php");
	class Professeur extends Utilisateur
	{
		
		function __construct($pseudo,
						 	 $nom,
							 $prenom,
							 $sexe,
							 $password)
		{
			parent::__construct($pseudo,
								$nom,
								$prenom,
								$sexe,
								$password);
		}
	}
?>