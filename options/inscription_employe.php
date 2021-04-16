<h1>Inscription employé</h1>
<form method="post" action="requetes.php">
	<input type='hidden' name='operation' value='inscription_employe'>
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
	<label>Poste : </label>
	<select name="poste">
		<option value="SECRÉTAIRE" selected>SECRÉTAIRE</option>
		<option value="PROVISEUR">PROVISEUR</option>
		<option value="VIE SCOLAIRE">VIE SCOLAIRE</option>
	</select><br>
	<br>
	<input type='submit' value='Valider' />
</form>