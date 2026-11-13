<?php 

if (isset ($_POST["Calculer"])) {
    $lg = $_POST["lg"];
    $lr = $_POST["lr"];

    $s = lg*lr;
    $p = 2*(lg + lr);

    printf("La surface est de : %f <br>", $s);
    printf("Le périmètre est de : %f ", $p);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice - rectangle</title>
</head>
<body>
    <h1>Exercice rectangle</h1>
    <form method="POST">
        longueur: <br>
        <input type="text" name="lg"> <br>
        largeur: <br>
        <input type="text" name="lr"><br>
        <input type="submit" name="Calculer" value="Calculer">

    </form>
</body>
</html>