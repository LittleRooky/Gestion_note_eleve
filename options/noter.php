<?php
	include 'classes/ActionsDB.php';

	$gestionnaire_bdd = new ActionsDB(new ConnectionDB());

	if (!isset($_POST['etape']) &&
		!isset($_GET['etape'])) {
		echo '<h1>Noter (1 / 3) </h1>';
		
		$professeurs = array();
		
		$professeurs = $gestionnaire_bdd->getAllProfesseurs();
?>
		<form method="post" action="requetes.php">
			<input type='hidden' name='operation' value='noter'>
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
			echo '<h1>Noter (2 / 3) </h1>';

			$professeur = $gestionnaire_bdd->getNomPrenomProfesseur($_GET['utilisateur']);

			echo "<h3>Professeur : ".$professeur["nom"]." ".$professeur["prenom"].'</h3>';

			$les_matieres_prof = $gestionnaire_bdd->getMatieresEnseignees($_GET['utilisateur']);
?>
			<form method="post" action="requetes.php">
				<input type='hidden' name='operation' value='noter'>
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

			echo '<h1>Noter (3 / 3) </h1>';

			$professeur = $gestionnaire_bdd->getNomPrenomProfesseur($_GET['utilisateur']);

			$matiere = $gestionnaire_bdd->getNomMatiere($_GET['matiere']);

			echo "<h3>".$professeur["nom"]." ".$professeur["prenom"].' - '.$matiere["nom"].'</h3>';

			$les_eleves = $gestionnaire_bdd->getAllEleves();
?>
			<form method="post" action="requetes.php">
				<input type='hidden' name='operation' value='noter'>
				<input type='hidden' name='etape' value='3'>
				<input type='hidden' name='matiere' value='<?php echo $_GET['matiere'] ?>'>
				<label>Date : </label>
				<input type="date" name="date_examen" value="<?php echo date("Y-m-d");?>"><br><br>
				<table>
					<thead>
				        <tr>
				            <th>Nom et prénom</th>
				            <th>Note</th>
				        </tr>
				    </thead>
				    <tbody>
<?php
						foreach ($les_eleves as $eleve) {
?>
						<tr>
				            <td>
				            	<?php echo $eleve->getNom()." ".$eleve->getPrenom() ?>
				            </td>
				            <td>
				            	<input type='number' name='note[]' value=-1 min=-1 max=20 step=0.05 required>
				            	<input type='hidden' name='eleve[]' value='<?php echo $eleve->getPseudo() ?>'>
				            </td>
				        </tr>
<?php
						}
?>
			    	</tbody>
				</table>
				<br>
				<input type='submit' value="Valider">
			</form>
<?php
		}
	}
?>