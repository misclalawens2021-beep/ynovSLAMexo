<?php // Ouverture du bloc PHP
	require_once("controleur/controleur.class.php"); // Charge la classe Controleur (une seule fois)
	$unControleur = new Controleur (); // Crée l'objet Controleur (qui crée le Modele et la connexion BDD)
?>
<!DOCTYPE html> <!-- Déclaration du type de document : HTML5 -->
<html> <!-- Début du document HTML -->
<head> <!-- En-tête de la page -->
	<title>TP AUTH</title> <!-- Titre affiché dans l'onglet du navigateur -->
</head> <!-- Fin de l'en-tête -->
<body> <!-- Corps de la page -->
<center> <!-- Centre le contenu (balise obsolète, remplaçable par du CSS) -->
	<img src="images/logo_ynov.png" height="150" width="250"> <!-- Logo de l'école Ynov, 250x150 px -->
	<h1> Site intranet de l'école Ynov </h1> <!-- Titre principal de la page -->
	<?php // Réouverture d'un bloc PHP
	require_once ("vue/vue_connexion.php"); // Affiche le formulaire de connexion
	if(isset($_POST['Valider'])){ // Si le bouton "Valider" a été cliqué (formulaire de connexion envoyé)
		$email = $_POST['email']; // Récupère l'email saisi
		$mdp   = $_POST['mdp']; // Récupère le mot de passe saisi

		$unUser =$unControleur->selectWhereUser($email, $mdp); // Tente l'authentification via le contrôleur
		if($unUser == null){ // Si aucun utilisateur retourné : échec
			echo "<br> Veuillez vérifier vos identifiants."; // Message d'erreur affiché à l'utilisateur
		} else { // Sinon : authentification réussie
			echo "<br> Bienvenue ".$unUser['nom']." ".$unUser['prenom']; // Message de bienvenue avec nom et prénom
			// récupérer la date de changement MDP
			$dtMdp = $unUser['dateMdp']; // Date du dernier changement de mot de passe (en base)
			echo "<br> date Mdp dernière connexion :" . $dtMdp; // Affiche cette date
			// récupérer la date d'aujourd'hui
			$dtAuj = date("Y-m-d"); // Date du jour au format AAAA-MM-JJ
			echo "<br> Date aujourd'hui :" . $dtAuj; // Affiche la date du jour

			// on calcule le nb jours de différence
			$d1 = new DateTime($dtMdp); // Objet DateTime pour la date du dernier changement de MDP
			$d2 = new DateTime($dtAuj); // Objet DateTime pour la date d'aujourd'hui

			$diff = $d2-> diff($d1); // Calcule l'écart entre les deux dates (objet DateInterval)
			echo "<br> Différence :" .$diff->days; // Affiche le nombre total de jours d'écart
			$nbjours = $diff->days; // Stocke le nombre de jours dans une variable
			
			if ($nbjours >= 30){ // Si le MDP a 30 jours ou plus : changement obligatoire
				// changement de MDP
				require_once("vue/vue_change_mdp.php"); // Affiche le formulaire de changement de MDP (utilise $email)
				$tabMdp = $unControleur->genererMdp(); // Génère 5 propositions de mots de passe conformes CNIL
				echo "<br> Proposition : " . implode(",", $tabMdp); // Affiche les propositions séparées par des virgules
			} // Fin du test des 30 jours
		} // Fin du if/else d'authentification
	} // Fin du traitement du formulaire de connexion

	if (isset($_POST['Modifier'])){ // Si le bouton "Modifier" a été cliqué (formulaire de changement de MDP envoyé)
		$mdp1 = $_POST['mdp1']; // Récupère le nouveau mot de passe
		$mdp2 = $_POST['mdp2']; // Récupère la confirmation
		$email = $_POST['email']; // Récupère l'email (champ caché du formulaire)
		if ($mdp1 == $mdp2){ // Vérifie que les deux saisies sont identiques
			if($unControleur->verifAnciens($email, $mdp1) == null){ // Vérifie que le MDP n'a jamais été utilisé auparavant
				$unControleur->change_mdp($email, $mdp1); // Enregistre le nouveau MDP (haché avec le sel)
				echo "<br> Changement réussi du MDP"; // Message de succès
			} else { // Sinon : le MDP figure dans l'historique
			echo "<br> Mot de passe déjà utilisé."; // Message d'erreur : MDP déjà utilisé
		} // Fin du test de l'historique
		// else { // Branche prévue pour des MDP différents (désactivée)
		// 	echo "<br> Pas d'équivalence des deux mots de passes."; // Message d'erreur prévu
		// }
	} // Fin du test mdp1 == mdp2
	} // Fin du traitement du formulaire de changement de MDP
	?>
</center> <!-- Fin du bloc centré -->
</body> <!-- Fin du corps de la page -->
</html> <!-- Fin du document HTML -->