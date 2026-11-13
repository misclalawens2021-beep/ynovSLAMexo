<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nombres parfaits</title>
</head>
<body>
    <center>
        <h1>Nombres parfaits :</h1>
        <form method="POST">
            <p>Entrer une borne minimal : <br></p>
            <input type="text" name="bMin"><br>
            <p>Entrer une borne maximal : <br></p>
            <input type="text" name="bMax"><br>

            <input type="submit" name="Resultat" value="Resultat">
        </form>
    </center>
</body>
</html>

<?php

if (isset($_POST["Resultat"])) {
    
    $bMin = $_POST["bMin"];
    $bMax = $_POST["bMax"];

    echo "Nombres parfaits entre $bMin et $bMax :<br>";

    for ($n = $bMin; $n < $bMax; $n++) {
        $smDiv = 0;
    

        for ($i = 1; $i < $n-1; $i++){
            if ($n % $i == 0) {
                $smDiv = $smDiv + $i;
            }
        }

        if ($smDiv == $n && $n > 0) {
            printf($n);
        }
    }
}