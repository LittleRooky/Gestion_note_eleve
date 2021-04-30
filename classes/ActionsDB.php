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

		//Add code
		public function getAllEmployes_Professeurs()
{
/*
Requête qui va obtenir le pseudo, nom, prenom, ... de tous les
( employes et les professeurs ) = utilisateurs.
*/
$requete = "select pseudo, nom, prenom, sexe, password 
    from utilisateur U
    where pseudo in (select pseudo
    from employe) or
  pseudo in (select pseudo
    from professeur)
    order by nom, prenom, pseudo";


$reponse = $this->conn_db->getDB()->prepare($requete);
$reponse->execute();


$employes_professeurs = array();


include("classes/Employe.php");

while ($donnees = $reponse->fetch()) {
/*
Les Employes qu'on ajoute au tableau
*/
$employes_professeurs[] = new Employe($donnees['pseudo'],
  $donnees['nom'],
  $donnees['prenom'],
  $donnees['sexe'],
  $donnees['password'],
  "");
}


return $employes_professeurs;
}




public function getNomPrenomEmploye($pseudo)
{
$requete = "select nom, prenom 
from utilisateur 
where pseudo = :pseudo";


$reponse = $this->conn_db->getDB()->prepare($requete);


$reponse->bindValue("pseudo", $pseudo, PDO::PARAM_STR);


$reponse->execute();


$donnees = $reponse->fetch();


$employe = array('nom' => $donnees["nom"],
'prenom' => $donnees["prenom"]);


return $employe;
}






public function getOptionsChecked($pseudo)
{
$requete = "select ido 
from avoir
where pseudo = :pseudo";


$reponse = $this->conn_db->getDB()->prepare($requete);


$reponse->bindValue("pseudo", $pseudo, PDO::PARAM_STR);


$reponse->execute();


$lesoptionschecked = array();


while ($donnees = $reponse->fetch()) {
$lesoptionschecked[] = $donnees['ido'];
}

return $lesoptionschecked;
}




public function getAllOptions()
{
$requete = "select id, nom
from options";


$reponse = $this->conn_db->getDB()->prepare($requete);


$reponse->execute();


$lesoptions = array();


while ($donnees = $reponse->fetch()) {
$lesoptions[] = array('id' => $donnees['id'],
  'nom' => $donnees['nom']);
}


return $lesoptions;
}

public function addOptionsUtilisateur($les_options, $pseudo_utilisateur)
{
$this->deleteOptionsUtilisateur($pseudo_utilisateur);


foreach ($les_options as $option) {
$requete = "insert into avoir values (:option, :pseudo_utilisateur)";


$reponse = $this->conn_db->getDB()->prepare($requete);


$reponse->bindValue("option", $option, PDO::PARAM_INT);
$reponse->bindValue("pseudo_utilisateur", $pseudo_utilisateur, PDO::PARAM_STR);


$reponse->execute();
}
}


private function deleteOptionsUtilisateur($pseudo_utilisateur)
{
$requete = "delete from avoir
where pseudo = :pseudo_utilisateur";


$reponse = $this->conn_db->getDB()->prepare($requete);


$reponse->bindValue("pseudo_utilisateur", $pseudo_utilisateur, PDO::PARAM_STR);


$reponse->execute();
}



public function getAllProfesseurs()
{
$requete = "select U.pseudo, nom, prenom, sexe, password
    from professeur P, utilisateur U 
    where U.pseudo = P.pseudo
    order by nom, prenom, pseudo";


$reponse = $this->conn_db->getDB()->prepare($requete);
$reponse->execute();


$professeurs = array();


include("classes/Professeur.php");

while ($donnees = $reponse->fetch()) {
/*
Les Professeurs qu'on ajoute au tableau
*/
$professeurs[] = new Professeur($donnees['pseudo'],
  $donnees['nom'],
  $donnees['prenom'],
  $donnees['sexe'],
  $donnees['password']);
}


return $professeurs;
}





public function getNomPrenomProfesseur($pseudo)
{
$requete = "select nom, prenom 
from utilisateur 
where pseudo = :pseudo";


$reponse = $this->conn_db->getDB()->prepare($requete);


$reponse->bindValue("pseudo", $pseudo, PDO::PARAM_STR);


$reponse->execute();


$donnees = $reponse->fetch();


$professeur = array('nom' => $donnees["nom"],
    'prenom' => $donnees["prenom"]);


return $professeur;
}








public function getMatieresEnseignees($pseudo)
{
$requete = "select id, nom 
from dispense D, matiere M
where pseudo = :pseudo
and M.id = D.idm";


$reponse = $this->conn_db->getDB()->prepare($requete);


$reponse->bindValue("pseudo", $pseudo, PDO::PARAM_STR);


$reponse->execute();


$matieres = array();


while ($donnees = $reponse->fetch()) {
$matieres[] = array('id' => $donnees["id"],
      'nom' => $donnees["nom"]);
}


return $matieres;
}








public function getNomMatiere($id)
{
$requete = "select id, nom 
from matiere 
where id = :id";


$reponse = $this->conn_db->getDB()->prepare($requete);


$reponse->bindValue("id", $id, PDO::PARAM_STR);


$reponse->execute();


$matiere = array();


$donnees = $reponse->fetch();

$matiere = array('id' => $donnees["id"],
'nom' => $donnees["nom"]);


return $matiere;
}






public function getAllEleves()
{
$requete = "select U.pseudo, nom, prenom, sexe, password, classe
    from eleve E, utilisateur U 
    where U.pseudo = E.pseudo
    order by nom, prenom, pseudo";


$reponse = $this->conn_db->getDB()->prepare($requete);
$reponse->execute();


$eleves = array();


include("classes/Eleve.php");

while ($donnees = $reponse->fetch()) {
/*
Les Professeurs qu'on ajoute au tableau
*/
$eleves[] = new Eleve($donnees['pseudo'],
  $donnees['nom'],
  $donnees['prenom'],
  $donnees['sexe'],
  $donnees['password'],
  $donnees['classe']);
}


return $eleves;
}




public function addExamen($matiere, $eleve, $note, $date_examen)
{
if ($note >= 0) {
$requete = "insert into suivre values 
(:pseudo, :matiere, :date_examen, :note)";


$reponse = $this->conn_db->getDB()->prepare($requete);


$reponse->bindValue("pseudo", $eleve, PDO::PARAM_STR);
$reponse->bindValue("matiere", $matiere, PDO::PARAM_INT);
$reponse->bindValue("date_examen", $date_examen, PDO::PARAM_STR);
$reponse->bindValue("note", $note);


$reponse->execute();
}
}


public function getAllNotesMoyenneMatiere($matiere)
{
$requete = "select U.pseudo, U.nom, U.prenom, M.id, note, moyenne 
from suivre S 
inner join matiere M on M.id = S.idm 
inner join utilisateur U on U.pseudo = S.pseudo 
inner join (select pseudo, idm, avg(note) as moyenne
from suivre
where idm = :matiere
group by pseudo, idm) My on My.pseudo = U.pseudo and My.idm = M.id
where M.id = :matiere 
group by U.pseudo, U.nom, note
order by moyenne desc";


$reponse = $this->conn_db->getDB()->prepare($requete);


$reponse->bindValue("matiere", $matiere, PDO::PARAM_INT);


$reponse->execute();


$les_notes_moyenne_matiere = array();


$rang = 0;


$donnees = $reponse->fetchAll();


$position = 0;


/*echo '<pre>';
print_r($donnees);
echo '</pre>';*/


while ($position < count($donnees)) {
$rang++;
$nom_prenom = $donnees[$position]['nom']." ".$donnees[$position]['prenom'];
$pseudo = $donnees[$position]['pseudo'];
$moyenne = $donnees[$position]['moyenne'];


$notes = array();
$sortir = false;
do {
if ($pseudo == $donnees[$position]['pseudo']) {
$notes[] = $donnees[$position]['note'];
$position++;
}
else 
$sortir = true;
} while (!$sortir);


$les_notes_moyenne_matiere[] = array('rang' => $rang,
   'nom_prenom' => $nom_prenom,
   'notes' => $notes,
   'moyenne' => $moyenne);
}


/*echo '<pre>';
print_r($les_notes_moyenne_matiere);
echo '</pre>';*/


return $les_notes_moyenne_matiere;
}
	}
?>