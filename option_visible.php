<?php 
	if (isset($_GET['operation'])) {
		if ($_GET['operation'] == "inscription_eleve") {
		        include "options/".$_GET['operation'].'.php';
		}
		elseif ($_GET['operation'] == "inscription_employe") {
			include "options/".$_GET['operation'].'.php';
		}

		elseif ($_GET['operation'] == "attribution_droits") {
			include "options/".$_GET['operation'].'.php';
		}

		elseif ($_GET['operation'] == "noter") {
			include "options/".$_GET['operation'].'.php';
		}

		elseif ($_GET['operation'] == "affichage_notes_matiere") {
			include "options/".$_GET['operation'].'.php';
		}
	} 
?>