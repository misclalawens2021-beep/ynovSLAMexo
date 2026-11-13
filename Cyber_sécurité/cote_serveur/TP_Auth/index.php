<?php
	require_once("controleur/controleur.class.php"); 
	$unControleur = new Controleur ();
?>
<!DOCTYPE html>
<html>
<head>
	<title>TP AUTH</title>
</head>
<body>
<center>
	<img src="images/logo_ynov.png" height="150" width="250">
	<h1> Site intranet de l'école Ynov </h1>
	<?php
	require_once ("vue/vue_connexion.php");
	if(isset($_POST['Valider'])){
		$email = $_POST['email']; 
		$mdp   = $_POST['mdp']; 

		$unUser =$unControleur->selectWhereUser($email, $mdp); 
		if($unUser == null){
			echo "<br> Veuillez vérifier vos identifiants."; 
		}else {
			echo "<br> Bienvenue ".$unUser['nom']." ".$unUser['prenom'];
			// récupérer la date de changement MDP
			$dtMdp = $unUser['dateMdp'];
			echo "<br> date Mdp dernière connexion :" . $dtMdp;
			// récupérer la date d'aujourd'hui
			$dtAuj = date("Y-m-d");
			echo "<br> Date aujourd'hui :" . $dtAuj;

			// on calcule le nb jours de différence
			$d1 = new DateTime($dtMdp);
			$d2 = new DateTime($dtAuj);

			$diff = $d2-> diff($d1);
			echo "<br> Différence :" .$diff->days;
			$nbjours = $diff->days;
			
			if ($nbjours >= 30){
				// changement de MDP
				require_once("vue/vue_change_mdp.php");
			}
		}
	}

	if (isset($_POST['modifier'])){
		$mdp1 = $_POST['mdp1'];
		$mdp2 = $_POST['mdp2'];
		$email = $_POST['email'];
		if ($mdp1 == $mdp2){
			if($unControleur->verifAnciens($email, $mdp) == null){
				$controleur->change_mdp($email, $mdp1);
				echo "<br> Changement réussi du MDP";
			} else {
			echo "<br> Mot de passe déjà utilisé.";
		} else {
			echo "<br> Pas d'équivalence des deux mots de passes.";
		}
	}
	}
	?>
</center>
</body>
</html>