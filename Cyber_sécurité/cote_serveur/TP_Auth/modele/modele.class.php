<?php
	/*
	classe qui gère les requetes injection/extraction des 
	données à partir du serveur mysql utilisant la classe PDO : PHP DATA Object
	*/
	class Modele {
		private $unPdo ; //une instance (objet) de la classe PDO
		public function __construct (){
			//etablissement de la connexion à la BDD 
			$serveur = "localhost";
			//port = 3306 pour mysql 
			$bdd = "tp_auth"; 
			$user = "root"; 
			$mdp = "";
			$url ="mysql:host=".$serveur.";dbname=".$bdd; 
			try{
				$this->unPdo = new PDO($url, $user, $mdp);
			}
			catch(PDOException $exp){
				echo "<br> Erreur de connexion BDD : ".$exp->getMessage();
			}
		}
		public function selectWhereUser ($email, $mdp){
			$requete ="select * from user where email='".$email."' and mdp ='".$mdp."' ;"; 
			//preparation avant execution
			$exec = $this->unPdo->prepare ($requete); 
			//execution de la requete 
			$exec->execute(); 
			//extraction d'un enregistrement
			$unUser = $exec->fetch(); 
			return $unUser;
		}
		public function selectWhereUser_1 ($email, $mdp){
			$requete ="select * from user where email=:email and mdp = :mdp;";
			//preparation avant execution
			$exec = $this->unPdo->prepare ($requete); 
			//execution de la requete 
			$donnees = array(":email"=>$email, ":mdp"=>$mdp);
			$exec->execute($donnees); 
			//extraction d'un enregistrement
			$unUser = $exec->fetch(); 
			return $unUser;
		}
		public function selectWhereUser_2 ($email, $mdp){
			$requete ="select * from user where email=? and mdp = ?;";
			//preparation avant execution
			$exec = $this->unPdo->prepare ($requete); 
			//execution de la requete 
			$exec->bindValue(1, $email,PDO::PARAM_STR); 
			$exec->bindValue(2, $mdp, PDO::PARAM_STR);
			$exec->execute(); 
			//extraction d'un enregistrement
			$unUser = $exec->fetch(); 
			return $unUser;
		}

		public function getGrainSel (){
			$requete = "select nb from grainSel;";
			$exec = $this->unPdo->prepare ($requete); 
			$exec->execute(); 
			return $exec->fetch(); 
		}

		// public function change_mdp($email, $mdp1){
		// 	$gsel = $this->unModele->getGrainSel()['nb'];
		// 	$mdp1 = sha1($mdp1.$gsel);
		// 	$this->unModele->change_mdp($email, $mdp1);
		// }

		public function change_mdp($email, $mdp1){
			$requete = "update user set mdp = :mdp, dateMdp = curdate() email = :email;";
			$exec = $this->unPdo->prepare ($requete); 
			$tab = array(":email" => $email, ":mdp" =>$mdp1);
			$exec->execute($tab);

			$requete = "insert into anciensMdp values(null, :email, :mdp, curdate());";
			$exec = $this->unPdo->prepare($requete);
			$exec->execute($tab);
		}

		public function verifAnciensMdp($email, $mdp){
			$requete = "select * from anciensMdp where email = :email and mdp = :mdp;";
			$exec = $this->unPDO->prepare($requete);
			$tab = array(":email"=>$email, ":mdp"=>$mdp);
			$exec = execute($tab);
			return $exec->fetch();
		}
	}	
?>




