<?php
	/**
	* Classe qui va gerer tout ce qu'on fera dans la base de données
		<=> 
	  Ajouts, Suppression, MAJ, et Récupération d'informations
	*/
	class ActionsDB
	{
		private $conn_db;

		function __construct($conn_db)
		{
			$this->conn_db = $conn_db;
		}

		public function setConn_DB($conn_db)
		{
			$this->conn_db = $conn_db;
		}

		public function getConn_DB()
		{
			return $this->conn_db;
		}

		private function inscription_utilisateur($pseudo, 
																																	$nom, 
																																	$prenom, 
																																	$sexe,
																																	$password)
		{
				// Création de la requete avec des parametres ou marqueurs
				$requete = "insert into utilisateur values (:pseudo, 
																																					:nom, 
																																					:prenom, 
																																					:sexe, 
																																					:password)";

					$reponse = $this->conn_db->getDB()->prepare($requete);

					/*
					valorisation des paramétres/marquers (pseudo, nom, prenom, sexe, password)
					en vérifiant les types
					*/
					$reponse->bindValue("pseudo", $pseudo, PDO::PARAM_STR);
					$reponse->bindValue("nom", $nom, PDO::PARAM_STR);
					$reponse->bindValue("prenom", $prenom, PDO::PARAM_STR);
					$reponse->bindValue("sexe", $sexe, PDO::PARAM_STR);
					$reponse->bindValue("password", $password, PDO::PARAM_STR);

					// executer la requete SQL
					$reponse->execute();
		}

		public function inscription_eleve($eleve)
		{
			/*
				Inserer d'abord l'utilisateur
			*/

		
				$this->inscription_utilisateur($eleve->getPseudo(), 
																												$eleve->getNom(), 
																												$eleve->getPrenom(), 
																												$eleve->getSexe(), 
																												$eleve->getPassword());

			/*
				Inserer d'abord l'élève
			*/

			// Création de la requete avec des parametres ou marqueurs
			$requete = "insert into eleve values (:pseudo,
												  :classe)";

			$reponse = $this->conn_db->getDB()->prepare($requete);

			$reponse->bindValue("pseudo", $eleve->getPseudo(), PDO::PARAM_STR);
			$reponse->bindValue("classe", $eleve->getClasse(), PDO::PARAM_STR);

			// executer la requete SQL
			$reponse->execute();
		}
		public function inscription_employe($employe)
		{
			/*
				Inserer d'abord l'utilisateur
			*/

			$this->inscription_utilisateur($employe->getPseudo(), 
																											$employe->getNom(), 
																											$employe->getPrenom(), 
																											$employe->getSexe(), 
																											$employe->getPassword());


			/*
				Inserer d'abord l'élève
			*/

			// Création de la requete avec des parametres ou marqueurs
			$requete = "insert into employe values (:pseudo,
												  :poste)";

			$reponse = $this->conn_db->getDB()->prepare($requete);

			$reponse->bindValue("pseudo", $employe->getPseudo(), PDO::PARAM_STR);
			$reponse->bindValue("poste", $employe->getPoste(), PDO::PARAM_STR);

			// executer la requete SQL
			$reponse->execute();
		}
	}
?>