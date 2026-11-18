<?php // Ouverture du bloc PHP
	/*
	classe qui gère les requetes injection/extraction des 
	données à partir du serveur mysql utilisant la classe PDO : PHP DATA Object
	*/
	class Modele { // Déclaration de la classe Modele (accès à la base de données)
		private $unPdo ; // une instance (objet) de la classe PDO
		public function __construct (){ // Constructeur : établit la connexion dès la création de l'objet
			// etablissement de la connexion à la BDD 
			$serveur = "localhost"; // Adresse du serveur MySQL
			// port = 3306 pour mysql 
			$bdd = "tp_auth"; // Nom de la base de données
			$user = "root"; // Identifiant MySQL (root : à éviter en production)
			$mdp = ""; // Mot de passe MySQL (vide en local)
			$url ="mysql:host=".$serveur.";dbname=".$bdd; // DSN : chaîne de connexion PDO
			try{ // Début du bloc de gestion d'erreur
				$this->unPdo = new PDO($url, $user, $mdp); // Crée la connexion PDO et la stocke dans l'attribut
			} // Fin du try
			catch(PDOException $exp){ // Si la connexion échoue, on attrape l'exception
				echo "<br> Erreur de connexion BDD : ".$exp->getMessage(); // Affiche le message d'erreur
			} // Fin du catch
		} // Fin du constructeur
		public function selectWhereUser ($email, $mdp){ // Version 0 : requête NON sécurisée (concaténation)
			$requete ="select * from user where email='".$email."' and mdp ='".$mdp."' ;"; // Variables collées dans le SQL : vulnérable à l'injection SQL
			// preparation avant execution
			$exec = $this->unPdo->prepare ($requete); // Prépare la requête
			// execution de la requete 
			$exec->execute(); // Exécute la requête
			// extraction d'un enregistrement
			$unUser = $exec->fetch(); // Récupère la première ligne du résultat
			return $unUser; // Retourne l'utilisateur (ou false si aucun)
		} // Fin de selectWhereUser
		public function selectWhereUser_1 ($email, $mdp){ // Version 1 : paramètres nommés (:email, :mdp)
			$requete ="select * from user where email=:email and mdp = :mdp;"; // Requête avec marqueurs nommés
			// preparation avant execution
			$exec = $this->unPdo->prepare ($requete); // Prépare la requête
			// execution de la requete 
			$donnees = array(":email"=>$email, ":mdp"=>$mdp); // Tableau associatif marqueur => valeur
			$exec->execute($donnees); // Exécute en passant les valeurs (protégé contre l'injection)
			// extraction d'un enregistrement
			$unUser = $exec->fetch(); // Récupère la première ligne
			return $unUser; // Retourne l'utilisateur
		} // Fin de selectWhereUser_1
		public function selectWhereUser_2 ($email, $mdp){ // Version 2 : paramètres positionnels (?) avec bindValue
			$requete ="select * from user where email=? and mdp = ?;"; // Requête avec marqueurs positionnels
			// preparation avant execution
			$exec = $this->unPdo->prepare ($requete); // Prépare la requête
			// execution de la requete 
			$exec->bindValue(1, $email,PDO::PARAM_STR); // Lie le 1er ? à l'email (type chaîne)
			$exec->bindValue(2, $mdp, PDO::PARAM_STR); // Lie le 2e ? au mot de passe (type chaîne)
			$exec->execute(); // Exécute la requête
			// extraction d'un enregistrement
			$unUser = $exec->fetch(); // Récupère la première ligne
			return $unUser; // Retourne l'utilisateur
		} // Fin de selectWhereUser_2

		public function selectWhereUser_3 ($email){ // Version 3 : recherche par email seul, compte actif uniquement
			$requete ="select * from user where email=? and actif = 1;"; // Le mot de passe est comparé ensuite dans le contrôleur
			// preparation avant execution
			$exec = $this->unPdo->prepare ($requete); // Prépare la requête
			// execution de la requete 
			$exec->bindValue(1, $email,PDO::PARAM_STR); // Lie le ? à l'email
			// $exec->bindValue(2, $mdp, PDO::PARAM_STR); // Ancien 2e paramètre (mot de passe) désactivé
			$exec->execute(); // Exécute la requête
			// extraction d'un enregistrement
			$unUser = $exec->fetch(); // Récupère la première ligne
			return $unUser; // Retourne l'utilisateur (ou false)
		} // Fin de selectWhereUser_3

		public function setNbTentatives($email, $nb){ // Met à jour le compteur de tentatives de connexion
			/** $nb = 0 --> remise à 0 des tentatives
			 * $nb = 1 --> incrementer nbTentatives de 1 */
			if($nb == 0){ // Cas : remise à zéro
				$requete = "update user set nbTentatives = 0 where email=?;"; // Requête de remise à 0
			} else { // Cas : incrémentation
				$requete = "update user set nbTentatives = nbTentatives + 1 where email=?;"; // Requête d'ajout de 1
			} // Fin du if/else
			$exec = $this->unPdo->prepare($requete); // Prépare la requête choisie
			$exec -> bindValue(1, $email, PDO::PARAM_STR); // Lie le ? à l'email
			$exec -> execute(); // Exécute la mise à jour

		} // Fin de setNbTentatives
		

		public function desactiverCompte($email){ // Désactive le compte d'un utilisateur
			$requete = "update user set actif = 0 where email = ?;"; // Passe actif à 0
			$exec = $this->unPdo->prepare($requete); // Prépare la requête
			$exec -> bindValue(1, $email, PDO::PARAM_STR); // Lie le ? à l'email
			$exec -> execute(); // Exécute la mise à jour
		} // Fin de desactiverCompte

		public function getGrainSel (){ // Récupère le grain de sel stocké en base
			$requete = "select nb from grainSel;"; // Lit la colonne nb de la table grainSel
			$exec = $this->unPdo->prepare ($requete); // Prépare la requête
			$exec->execute(); // Exécute la requête
			return $exec->fetch(); // Retourne la ligne (tableau avec la clé 'nb')
		} // Fin de getGrainSel

		// public function change_mdp($email, $mdp1){ // Ancienne version placée par erreur dans le modèle (désactivée)
		// 	$gsel = $this->unModele->getGrainSel()['nb']; // Cette logique appartient au contrôleur
		// 	$mdp1 = sha1($mdp1.$gsel); // Hachage avec le sel
		// 	$this->unModele->change_mdp($email, $mdp1); // Appel récursif incorrect
		// } // Fin de l'ancienne version

		public function change_mdp($email, $mdp1){ // Enregistre le nouveau mot de passe (déjà haché)
			$requete = "update user set mdp = :mdp, dateMdp = curdate() where email = :email;"; // Met à jour le hash et la date du changement
			$exec = $this->unPdo->prepare ($requete); // Prépare la requête
			$tab = array(":email" => $email, ":mdp" =>$mdp1); // Valeurs des marqueurs nommés
			$exec->execute($tab); // Exécute la mise à jour de la table user

			$requete = "insert into anciensMdp values(null, :email, :mdp, curdate());"; // Archive le mot de passe dans l'historique (id auto, email, hash, date)
			$exec = $this->unPdo->prepare($requete); // Prépare l'insertion
			$exec->execute($tab); // Exécute l'insertion avec les mêmes valeurs
		} // Fin de change_mdp

		public function verifAnciens($email, $mdp){ // Cherche si ce mot de passe a déjà été utilisé par cet email
			$requete = "select * from anciensMdp where email = :email and mdp = :mdp;"; // Recherche dans l'historique
			$exec = $this->unPdo->prepare($requete); // Prépare la requête
			$tab = array(":email"=>$email, ":mdp"=>$mdp); // Valeurs des marqueurs nommés
			$exec -> execute($tab); // Exécute la requête
			return $exec->fetch(); // Retourne la ligne trouvée, ou false si jamais utilisé
		} // Fin de verifAnciens
	} // Fin de la classe Modele	
?>