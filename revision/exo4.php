<!DOCTYPE html>
<html>
<head>
    <title>procédure php</title>
</head>
<body>
<center>
    <h1> exercice procédure php </h1>
    <form method="post">
        Saisir un nombre entier : <br>
        <input type="text" name="nb"> <br>
        <input type="submit" name="Calculer" value="Calculer">
    </form>
    <?php
    
    function mesDiviseurs($nb) {
        for ($div = 1; $div <= $nb; $div++) {
            if($nb % $div == 0) {
                printf("<br> %d est un diviseur de %d", $div, $nb);
            }
        }
    }
    if (isset($_POST['Calculer'])) {
        $unNb = $_POST['nb'];
        // appel à la prochaine mesDiviseurs
        mesDiviseurs($unNb);
    }
    
    ?>
</center>
</body>
</html>