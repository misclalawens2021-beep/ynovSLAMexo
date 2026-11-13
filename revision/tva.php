<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TVA</title>
</head>
<body>
    <center>
        <h1>Calcul TVA :</h1>
        <form method="post">
            Donner un prix unitaire : <br>
            <input type="text" name="ht_uni"><br>
            Donner la quantité : <br>
            <input type="text" name="q"><br>
            Donner taux de TVA : <br>
            <input type="text" name="t_tva"><br>

            <input type="submit" name="Resultat" value="Resultat">
        </form>
    </center>
</body>
</html>
<?php

if (isset($_POST["Resultat"])){
    $ht_uni = $_POST["ht_uni"];
    $q = $_POST["q"];
    $t_tva = $_POST["t_tva"];
}

$v_tva = $ht_uni * ($t_tva / 100);
$p_ttc = $ht_uni + $v_tva;


printf("\n<center><br>Le prix TTC est de : %f<br><br>", $p_ttc);
printf("\nLe montant TVA est de : %f</center>", $v_tva);
?>