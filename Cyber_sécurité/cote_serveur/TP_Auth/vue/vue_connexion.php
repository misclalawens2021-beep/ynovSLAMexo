<h2> Connexion au site </h2> <!-- Titre de niveau 2 de la page -->
<form method="post"> <!-- Formulaire envoyé en POST vers la même page -->
	<table border="0"> <!-- Tableau sans bordure pour aligner libellés et champs -->
		<tr> <!-- Ligne 1 : email -->
			<td> Email : </td> <!-- Cellule du libellé -->
			<td> <input type="text" name="email"></td> <!-- Champ de saisie de l'email (lu via $_POST['email']) -->
		</tr> <!-- Fin de la ligne 1 -->
		<tr> <!-- Ligne 2 : mot de passe -->
			<td> MDP : </td> <!-- Cellule du libellé -->
			<td> <input type="password" name="mdp"></td> <!-- Champ masqué du mot de passe (lu via $_POST['mdp']) -->
		</tr> <!-- Fin de la ligne 2 -->
		<tr> <!-- Ligne 3 : boutons -->
			<td> <input type="reset" name="Annuler" value="Annuler"> </td> <!-- Bouton qui vide les champs du formulaire -->
			<td> <input type="submit" name="Valider" value="Valider" ></td> <!-- Bouton d'envoi ; son nom 'Valider' sert de test dans index.php -->
		</tr> <!-- Fin de la ligne 3 -->
	</table> <!-- Fin du tableau -->
</form> <!-- Fin du formulaire -->