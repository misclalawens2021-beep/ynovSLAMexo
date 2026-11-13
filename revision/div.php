<?php

if (isset($_POST["Afficher"])) {
    $nb = $_POST["nb"];
    for ($div = 1; $div<=$nb;$div++){
        if ($nb % $div == 0) {
            printf("<br> %d est un diviseur de %d", $div, $nb);
        }
    }
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diviseur</title>
</head>
<body>
    <center>
        <h1>Exercice Mes diviseurs</h1>
        <form method="POST">
            Entrer un nombre : <br>
            <input type="text" name="nb"><br>
            <input type="submit" name="Afficher" value="Afficher">
        </form>
    </center>
</body>
</html>