<?php 
	if (isset($_GET['operation'])) {
		if ($_GET['operation'] == "inscription_eleve") {
		        include "options/".$_GET['operation'].'.php';
		}
		elseif ($_GET['operation'] == "inscription_employe") {
			include "options/".$_GET['operation'].'.php';
		}
	} 
?>