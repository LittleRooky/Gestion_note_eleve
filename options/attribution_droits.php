<?php
	include 'classes/ActionsDB.php';

	$gestionnaire_bdd = new ActionsDB(new ConnectionDB());

	if (!isset($_POST['etape']) &&
		!isset($_GET['etape'])) {
		echo '<h1>Attribution de droits (1 / 2) </h1>';
		
		$employes = array();
		
		$employes = $gestionnaire_bdd->getAllEmployes_Professeurs();
?>
		<form method="post" action="requetes.php">
			<input type='hidden' name='operation' value='attribution_droits'>
			<input type='hidden' name='etape' value='1'>
			<label>Employé : </label>
			<select name='employe'>
			<?php
				foreach ($employes as $e) {
			?>
				<option value="<?php echo $e->getPseudo() ?>">
					<?php echo $e->getNom()." ".$e->getPrenom(); ?>
				</option>
			<?php
				}
			?>
			</select><br>
			<br>
			<input type='submit' value='Chercher'>
		</form>
<?php
	}
	else if (!isset($_POST['etape']) &&
			 isset($_GET['etape'])) {
		if ($_GET['etape'] == 2 &&
			$_GET['utilisateur'] != "") {
			echo '<h1>Attribution de droits (2 / 2) </h1>';

			$employe = $gestionnaire_bdd->getNomPrenomEmploye($_GET['utilisateur']);

			echo "<h3>Employé : ".$employe["nom"]." ".$employe["prenom"].'</h3>';

			$lesoptions = $gestionnaire_bdd->getAllOptions();

			$les_options_employe = $gestionnaire_bdd->getOptionsChecked($_GET['utilisateur']);
?>
			<form method="post" action="requetes.php">
				<input type='hidden' name='operation' value='attribution_droits'>
				<input type='hidden' name='etape' value='2'>
				<input type='hidden' name='pseudo' value='<?php echo $_GET['utilisateur'] ?>'>
				<fieldset style="width:25%;">
					<legend>Options des employés</legend>
					<?php
						$i = 0;
						while ($i < count($lesoptions)) {
							if (in_array($lesoptions[$i]['id'], $les_options_employe)) {
					?>
								<input type='checkbox' name='options[]' value="<?php echo $lesoptions[$i]['id'] ?>" checked>
								<?php echo $lesoptions[$i]['nom'] ?><br>
					<?php
							}
							else {
					?>
								<input type='checkbox' name='options[]' value="<?php echo $lesoptions[$i]['id'] ?>">
								<?php echo $lesoptions[$i]['nom'] ?><br>
					<?php
							}
							$i++;
						}
					?>
				</fieldset>
				<br>
				<input type='submit' value='Valider'>
			</form>
<?php
		}
	}
?>