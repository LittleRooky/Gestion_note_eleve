<h1>Inscription élève</h1>
<form method="post" action="requetes.php">
	<input type='hidden' name='operation' value='inscription_eleve'>
	<label>Pseudo : </label>
	<input type='text' name='pseudo' maxlength=30 size=30 required /><br>
	<label>Nom : </label>
	<input type='text' name='nom' maxlength=50 size=50 required /><br>
	<label>Prénom : </label>
	<input type='text' name='prenom' maxlength=100 size=50 required /><br>
	<label>Mot de passe : </label>
	<input type='password' name='password' maxlength=15 size=15 required /><br>
	<label>Sexo : </label>
	<select name="sexe">
		<option value="Masculin" selected>Masculin</option>
		<option value="Féminin">Féminin</option>
	</select><br>
	<label>Classe : </label>
	<select name="classe">
		<option value="STS1-SIO" selected>STS1-SIO</option>
		<option value="STS1-SLAM">STS1-SLAM</option>
		<option value="STS1-SISR">STS1-SISR</option>
		<option value="STS2-SLAM">STS2-SLAM</option>
		<option value="STS2-SISR">STS2-SISR</option>
	</select><br>
	<br>
	<input type='submit' value='Valider' />
</form>