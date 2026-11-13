<?php
    require_once ("tableau.class.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tableau</title>
</head>
<body>
<center>
    <h1>Classe Tableau</h1>
    <form method="post">
        Donner les éléments séparés par (;) : <br>
        <input type="text" name="tab"> <br>
        <input type="text" name="tab" value="Traiter">
    </form>
    <?php
    if (isset($_POST['Traiter'])){
        // instancier la classe tableau
        $unTableau = new Tableau();

        // saisir les éléments à partir du formulaire
        $unTableau->saisir($_POST);

        // afficher la moyenne des éléments
        echo "<br> La moyenne est de : ".$unTableau->moyenne();

        // afficher les min et max
        echo "<br>".$unTableau->minMax();

        //trier le tableau et afficher le tableau trié
        $unTableau->trier();
        echo "<br>Tableau trié: ".$unTableau->afficher();
    }
    ?>
</center>

</body>
</html>