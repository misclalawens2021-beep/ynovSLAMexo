<?php // Ouverture du bloc PHP
	require_once ("modele/modele.class.php"); // Charge le fichier de la classe Modele (une seule fois)

	class Controleur { // Déclaration de la classe Controleur (couche intermédiaire entre vues et modèle)
		private $unModele ; // Objet de la classe Modele (attribut privé)

		public function __construct(){ // Constructeur : exécuté à la création de l'objet
			// instanciation de la classe Modele
			$this->unModele = new Modele(); // Crée le Modele (ce qui ouvre aussi la connexion à la BDD)
		} // Fin du constructeur
		public function selectWhereUser($email, $mdp){ // Vérifie l'authentification d'un utilisateur
			//controler l'email // (à faire) validation du format de l'email

			//controler le mdp // (à faire) validation du mot de passe

			//$mdp = md5($mdp); // Ancienne version : hachage MD5 (faible, abandonné)

			//$mdp = sha1($mdp); // Ancienne version : hachage SHA1 sans sel (abandonné)
			
			$gsel = $this->unModele->getGrainSel()['nb']; // extraction du nb (grain de sel) à partir de la base
			$mdp = sha1($mdp.$gsel);  // application de la concaténation : mot de passe + grain de sel, puis hachage SHA1

			$unUser = $this->unModele->selectWhereUser_3($email); // Récupère l'utilisateur actif ayant cet email
			if ($unUser == null) return null; // Aucun utilisateur actif trouvé : échec, on sort
			if($mdp == $unUser['mdp']){ // Compare le hash calculé avec le hash stocké en base
				$this->unModele->setNbTentatives($email, 0); // Connexion réussie : remet le compteur de tentatives à 0
				return $unUser; // Retourne les données de l'utilisateur connecté
			} else { // Sinon : mot de passe incorrect
				// c'est une tentative : incrémenter le nombre de tentatives de 1
				$this->unModele->setNbTentatives($email, 1); // Ajoute 1 au nombre de tentatives en base
				if($unUser['nbTentatives'] + 1 >=5){ // Si on atteint 5 tentatives (valeur lue avant incrément, donc +1)
					$this->unModele->desactiverCompte($email); // Désactive le compte (actif = 0)
					return null; // Échec de connexion
				} // Fin du test des 5 tentatives
			} // Fin du if/else de comparaison des mots de passe
			 
		} // Fin de selectWhereUser (sans return explicite dans le else : renvoie null par défaut)

		public function change_mdp($email, $mdp1){ // Change le mot de passe d'un utilisateur
			$gsel = $this->unModele->getGrainSel()['nb']; // Récupère le grain de sel dans la base
			$mdp1 = sha1($mdp1.$gsel); // Concatène mot de passe + grain de sel puis hache en SHA1
			$this->unModele->change_mdp($email, $mdp1); // Demande au modèle d'enregistrer le nouveau hash
		} // Fin de change_mdp

		public function verifAnciens($email, $mdp){ // Vérifie si le mot de passe a déjà été utilisé
			return $this->unModele->verifAnciens($email, $mdp); // Délègue la recherche dans anciensMdp au modèle
		} // Fin de verifAnciens
		
		public function genererMdp(){ // Génère des propositions de mots de passe
		/** Génere aléatoirement 5 mdp dans un TAB avec respect des exigences de la CNIL :
		 * 		- au moins 12 caractères;
		 * 		- au moins une MAJ
		 * 		- au moins une min
		 * 		- au moins un chiffre
		 * 		- au moins un caractère spécial 
		 */
		$tabMdp = array(); // Tableau qui contiendra les 5 mots de passe générés
		$maj = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; // Jeu de caractères : majuscules
		$min = "abcdefghijklmnopqrstuvwxyz"; // Jeu de caractères : minuscules
		$chi = "0123456789"; // Jeu de caractères : chiffres
		$spe = "@&$=+-!."; // Jeu de caractères : caractères spéciaux autorisés
		$tout = $maj.$min.$chi.$spe; // Tous les caractères regroupés (pour les 8 caractères restants)
		for($i=1; $i<=5; $i++){ // Boucle : on génère 5 mots de passe
			$mdp = ""; // Initialise le mot de passe courant à vide
			// construction aléatoire de mdp
			$mdp .= $maj[random_int(0, strlen($maj)-1)]; // Ajoute 1 majuscule au hasard (garantit la règle MAJ)
			$mdp .= $min[random_int(0, strlen($min)-1)]; // Ajoute 1 minuscule au hasard (garantit la règle min)
			$mdp .= $chi[random_int(0, strlen($chi)-1)]; // Ajoute 1 chiffre au hasard (garantit la règle chiffre)
			$mdp .= $spe[random_int(0, strlen($spe)-1)]; // Ajoute 1 caractère spécial au hasard (garantit la règle spécial)

			for($j = 1; $j <= 8; $j++){ // Boucle : 8 caractères supplémentaires (4 + 8 = 12 au total)
				$mdp .= $tout[random_int(0, strlen($tout)-1)]; // Ajoute un caractère aléatoire parmi tous les jeux
			} // Fin de la boucle des 8 caractères
			// ajout du mdp dans le tableau
			$tabMdp[] = $mdp; // Ajoute le mot de passe généré à la fin du tableau
		} // Fin de la boucle des 5 mots de passe
		return $tabMdp; // Retourne le tableau des 5 propositions
		
		} // Fin de genererMdp
	} // Fin de la classe Controleur
?>