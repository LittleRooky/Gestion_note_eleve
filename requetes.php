<?php
	include("classes/ConnectionDB.php");

	if (isset($_POST['operation'])) {

		$operation = $_POST['operation'];

		if ($operation == 'inscription_eleve') {

			include("classes/ActionsDB.php");
			include("classes/Eleve.php");
			$gestionnaire_bdd = new ActionsDB(new ConnectionDB());

			$eleve = new Eleve($_POST['pseudo'],
																			$_POST['nom'],
																			$_POST['prenom'],
																			$_POST['sexe'],
																			$_POST['password'],
																			$_POST['classe']);

			$gestionnaire_bdd->inscription_eleve($eleve);

			echo '<meta http-equiv="refresh" content="0;URL=index.php?operation='.$operation.'">';
		}
		else	if ($operation == 'inscription_employe') {

			include("classes/ActionsDB.php");
			include("classes/Employe.php");

			$gestionnaire_bdd = new ActionsDB(new ConnectionDB());

			$employe = new Employe($_POST['pseudo'],
																			$_POST['nom'],
																			$_POST['prenom'],
																			$_POST['sexe'],
																			$_POST['password'],
																			$_POST['poste']);

			$gestionnaire_bdd->inscription_employe($employe);

			echo '<meta http-equiv="refresh" content="0;URL=index.php?operation='.$operation.'">';
			
		}

		//Add code
		elseif ($operation == 'attribution_droits') {
			if (isset($_POST['etape'])) {
			if ($_POST['etape'] == 1) {
			echo '<meta http-equiv="refresh" content="0;URL=index.php?operation='.$operation.'&etape=2&utilisateur='.$_POST['employe'].'">';
			}
			else if ($_POST['etape'] == 2) {
			$pseudo_utilisateur = $_POST['pseudo'];
			$les_options = $_POST['options'];
			
			
			include("classes/ActionsDB.php");
			
			
			$gestionnaire_bdd = new ActionsDB(new ConnectionDB());
			
			
			$gestionnaire_bdd->addOptionsUtilisateur($les_options, $pseudo_utilisateur);
			
			
			echo '<meta http-equiv="refresh" content="0;URL=index.php?operation='.$operation.'">';
			}
			}
			}


			elseif ($operation == 'noter') {
				if (isset($_POST['etape'])) {
				if ($_POST['etape'] == 1) {
				echo '<meta http-equiv="refresh" content="0;URL=index.php?operation='.$operation.'&etape=2&utilisateur='.$_POST['professeur'].'">';
				}
				else if ($_POST['etape'] == 2) {
				echo '<meta http-equiv="refresh" content="0;URL=index.php?operation='.$operation.'&etape=3&utilisateur='.$_POST['professeur'].'&matiere='.$_POST['matiere'].'">';
				}
				else if ($_POST['etape'] == 3) {
				$matiere = $_POST['matiere'];
				$eleve = $_POST['eleve'];
				$note = $_POST['note'];
				$date_examen = $_POST['date_examen'];
				
				
				echo $date_examen;
				
				
				include("classes/ActionsDB.php");
				
				
				$gestionnaire_bdd = new ActionsDB(new ConnectionDB());
				
				
				for ($i = 0; $i < count($note); $i++) { 
				$gestionnaire_bdd->addExamen($matiere, 
						 $eleve[$i], 
				$note[$i],
				$date_examen);
				}
				
				
				echo '<meta http-equiv="refresh" content="0;URL=index.php?operation='.$operation.'">';
				}
				}
				}



				elseif ($operation == 'affichage_notes_matiere') {
					if (isset($_POST['etape'])) {
					if ($_POST['etape'] == 1) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?operation='.$operation.'&etape=2&utilisateur='.$_POST['professeur'].'">';
					}
					else if ($_POST['etape'] == 2) {
					echo '<meta http-equiv="refresh" content="0;URL=index.php?operation='.$operation.'&etape=3&utilisateur='.$_POST['professeur'].'&matiere='.$_POST['matiere'].'">';
					}
					}
					}
	}
?>