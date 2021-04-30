<?php
	include 'classes/ActionsDB.php';

	$gestionnaire_bdd = new ActionsDB(new ConnectionDB());

	if (!isset($_POST['etape']) &&
		!isset($_GET['etape'])) {
		echo '<h1>Affichage notes (1 / 3) </h1>';
		
		$professeurs = array();
		
		$professeurs = $gestionnaire_bdd->getAllProfesseurs();
?>
		<form method="post" action="requetes.php">
			<input type='hidden' name='operation' value='affichage_notes_matiere'>
			<input type='hidden' name='etape' value='1'>
			<label>Professeur : </label>
			<select name='professeur'>
			<?php
				foreach ($professeurs as $p) {
			?>
				<option value="<?php echo $p->getPseudo() ?>">
					<?php echo $p->getNom()." ".$p->getPrenom(); ?>
				</option>
			<?php
				}
			?>
			</select><br>
			<br>
			<input type='submit' value='Valider'>
		</form>
<?php
	}
	else if (!isset($_POST['etape']) &&
			 isset($_GET['etape'])) {
		if ($_GET['etape'] == 2 &&
			$_GET['utilisateur'] != "") {
			echo '<h1>Affichage notes (2 / 3) </h1>';

			$professeur = $gestionnaire_bdd->getNomPrenomProfesseur($_GET['utilisateur']);

			echo "<h3>Professeur : ".$professeur["nom"]." ".$professeur["prenom"].'</h3>';

			$les_matieres_prof = $gestionnaire_bdd->getMatieresEnseignees($_GET['utilisateur']);
?>
			<form method="post" action="requetes.php">
				<input type='hidden' name='operation' value='affichage_notes_matiere'>
				<input type='hidden' name='etape' value='2'>
				<input type='hidden' name='professeur' value='<?php echo $_GET['utilisateur'] ?>'>
				<label>Matiere : </label>
				<select name='matiere'>
					<?php
						foreach ($les_matieres_prof as $m) {
					?>
							<option value='<?php echo $m['id'] ?>'>
								<?php echo $m['nom'] ?>
							</option>
					<?php
						}
					?>
				</select><br>
				<br>
				<input type='submit' value='Valider'>
			</form>
<?php
		}
		if ($_GET['etape'] == 3 &&
			$_GET['utilisateur'] != "") {

			echo '<h1>Affichage notes (3 / 3) </h1>';

			$professeur = $gestionnaire_bdd->getNomPrenomProfesseur($_GET['utilisateur']);

			$matiere = $gestionnaire_bdd->getNomMatiere($_GET['matiere']);

			echo "<h3>".$professeur["nom"]." ".$professeur["prenom"].' - '.$matiere["nom"].'</h3>';

			$notes_moyenne_matiere = $gestionnaire_bdd->getAllNotesMoyenneMatiere($_GET['matiere']);
?>
			<table border=1>
				<thead>
					<th>Rang</th>
					<th>Nom et prénom</th>
					<th>Notes</th>
					<th>Moyenne</th>
				</thead>
				<tbody>
<?php
					foreach ($notes_moyenne_matiere as $nmm) {
?>
						<tr>
							<td rowspan=<?php echo sizeof($nmm['notes']) ?>><?php echo $nmm['rang'] ?></td>
							<td rowspan=<?php echo sizeof($nmm['notes']) ?>><?php echo $nmm['nom_prenom'] ?></td>
							<td><?php echo $nmm['notes'][0] ?></td>
							<td rowspan=<?php echo sizeof($nmm['notes']) ?>><?php echo $nmm['moyenne'] ?></td>
						</tr>
<?php
						for ($la_note = 1; $la_note < sizeof($nmm['notes']); $la_note++) {					
?>
						<tr>
							<td><?php echo $nmm['notes'][$la_note] ?></td>
						</tr>
<?php
						}
					}
?>
				</tbody>
			</table>
<?php
		}
	}
?>