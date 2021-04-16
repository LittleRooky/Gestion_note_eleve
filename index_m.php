<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Gestionnaire de notes élèves</title>
  <link rel="stylesheet" href="css/style_menu.css">
  <script src="script.js"></script>
</head>
<body>
	<?php
		/*
			On inclut le contenu du fichier qui permet
			de se connecter à la BD.
		 */
		include("connexion_bdd/connexion_bdd.php");

		/* La variable $requette stocke la requette
		   qu'on veut faire à la BD 
		   Obtenir tous les champs (id, nom) 
		   de la table RUBRIQUE */
		$requette_r = "select * from rubrique;";

		/* 


		   Executer la requette sur la BD où
		   on s'est connecté.
		   La variable reponse va garder la vue
		   resultant.

		   Exemple:
		   id  |  nom
		   ----+--------------
		   1   |  RUBRIQUE 1
		   2   |  RUBRIQUE 2
		   3   |  RUBRIQUE 3 

		*/
	    $reponse_r = $bdd_menu->query($requette_r);
	?>
	<ul id="menu">
		<?php 
			/* 
				$reponse->fetch()
				recupere tuple par tuple du resultat de la 
				requette.
				Exemple: la premiere iteration 
				$reponse->fetch() aura la tuple
				1 | RUBRIQUE 1....

				La variable $donnees gardera cette information
				Pour acceder à chacun des valeurs de la tuple
				on fait $donnees["<nomduchamp>"]
			 */
			while ($donnees_r = $reponse_r->fetch())
			{
				$requette_o = "select * from options 
							  where idr = ".$donnees_r["id"];
				$reponse_o = $bdd_menu->query($requette_o);
			
				/*
				    Si $donnees["id"] vaut 1
					Exemple: resultat de la requette1
				   id  |  nom 			  |		| idr
				   ----+------------------+.....+ ----
				   1   |    Option 1 rub1 |		|	1
				   2   |    Option 2 rub1 |		|	1
				   3   |    Option 2 rub1 |		|	1
				*/
		?>		
				<li><a href="#"><?php echo $donnees_r["nom"]?></a>
					<ul>
					<?php 
						while ($donnees_o = $reponse_o->fetch())
						{
					?>
							<li><a href="#"><?php echo $donnees_o["nom"]?></a></li>
					<?php 
						}
					?>
					</ul>
				</li>
		<?php 
			}
		?>
	</ul>
</body>
</html>