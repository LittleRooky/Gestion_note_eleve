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
	}
?>