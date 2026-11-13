<?php
	require_once ("modele/modele.class.php"); 

	class Controleur {
		private $unModele ; //Objet de la classe Modele 

		public function __construct(){
			//instanciation de la classe Modele 
			$this->unModele = new Modele();
		}
		public function selectWhereUser($email, $mdp){
			//controler l'email 

			//controler le mdp

			//$mdp = md5($mdp); 
			
			//$mdp = sha1($mdp); 
			$gsel = $this->unModele->getGrainSel()['nb']; //extraction du nb a partir de la base
			$mdp = sha1($mdp.$gsel);  //application de la concatenation

			$unUser = $this->unModele->selectWhereUser_3($email); 
			if ($unUser == null) return null; 
			if($mdp == $unUser['mdp']){
				$this->unModele->setNbTentatives($email, 0);
				return $unUser;
			} else {
				// c'est une tentative : incrémenter le nombre de tentatives de 1
				$this->unModele->setNbTentatives($email, 1);
				if($unUser['nbTentatives'] + 1 >=5){
					$this->unModele->desactiverCompte($email);
					return null;
				}
			}
			 
		}

		public function change_mdp($email, $mdp1){
			$gsel = $this->unModele->getGrainSel()['nb'];
			$mdp1 = sha1($mdp1.$gsel);
			$this->unModele->change_mdp($email, $mdp1);
		}

		public function verifAnciens($email, $mdp){
			return $this->unModele->verifAnciens($email, $mdp);
		}
		
		public function genererMdp(){
		/** Génere aléatoirement 5 mdp dans un TAB avec respect des exigences de la CNIL :
		 * 		- au moins 12 caractères;
		 * 		- au moins une MAJ
		 * 		- au moins une min
		 * 		- au moins un chiffre
		 * 		- au moins un caractère spécial 
		 */
		$tabMdp = array();
		$maj = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$min = "abcdefghijklmnopqrstuvwxyz";
		$chi = "0123456789";
		$spe = "@&$=+-!.";
		$tout = $maj.$min.$chi.$spe;
		for($i=1; $i<=5; $i++){
			$mdp = "";
			// construction aléatoire de mdp
			$mdp .= $maj[random_int(0, strlen($maj)-1)];
			$mdp .= $min[random_int(0, strlen($min)-1)];
			$mdp .= $chi[random_int(0, strlen($chi)-1)];
			$mdp .= $spe[random_int(0, strlen($spe)-1)];

			for($j = 1; $j <= 8; $j++){
				$mdp .= $tout[random_int(0, strlen($tout)-1)];
			}
			// ajout du mdp dans le tableau
			$tabMdp[] = $mdp;
		}
		return $tabMdp;
		
		}
	}

	

?>