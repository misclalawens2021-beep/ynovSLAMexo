<?php
require_once("promotion.class.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Ynov</title>
</head>
<body>
    <center>
        <h1>Gestion des étudiants d'une promotion</h1>
        <!-- <form action="" method="POST"></form> -->
        <?php
        $e1=array("numCarte" => 1, "nom"=>"Chris", 
        "prenom"=> "Berkan", "montant"=>6000,
        "statut" => "initial");

        $e2=array("numCarte" => 2, "nom"=>"Mike", 
        "prenom"=> "Mathéo", "montant"=>0,
        "statut" => "alternant");

        $e3=array("numCarte" => 3, "nom"=>"Thomas", 
        "prenom"=> "Berkan", "montant"=>6500,
        "statut" => "initial");
        // Instanciation de la classe Promotion
        $unePromotion = new Promotion();
        // insertion des étudiants dans le tableau
        $unEtudiant_1 = new Etudiant();
        $unEtudiant_1-> saisir($e1);
        $unePromotion->ajouterEtudiant($unEtudiant_1);

        $unEtudiant_2 = new Etudiant();
        $unEtudiant_2-> saisir($e2);
        $unePromotion->ajouterEtudiant($unEtudiant_2);

        $unEtudiant_3 = new Etudiant();
        $unEtudiant_3-> saisir($e3);
        $unePromotion->ajouterEtudiant($unEtudiant_3);

        // Afficher la liste des étudiants : table html
        echo $unePromotion->listerEtudiants();

        // afficher la moyenne des montants
        echo "<br> La moyenne de scolarité : " . $unePromotion->moyenneMontants();

        echo "<h2> Liste des étudiants en alternance </h2>";
        // echo $unePromotion->listerEtudiants();
        $tab = $unePromotion->getEtudiant("alternant");
        $chaine = "<table border = '1'>
        <tr>
            <td> Num carte </td>
            <td> Nom </td>
            <td> Prenom </td>
            <td> Statut </td>
            <td> Montant </td>
        </tr> ";

        foreach($this->lesEtudiants as $unEtudiant){
            $chaine .= $unEtudiant->afficher();    
        }
        $chaine .= "</table>";

        echo "<h2> Liste des étudiants en initial </h2>";
        $tab = $unePromotion->getEtudiant("initial");
        var_dump($tab);
        ?>
    </center>
    
</body>
</html>