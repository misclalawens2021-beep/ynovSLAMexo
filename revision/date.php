<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATE en PHP</title>
</head>
<body>
    <center>
        <h1>ENTRER UNE DATE :</h1>
        <form method="POST">
            ENTRER UN JOUR : <br>
            <input type="text" name="d"><br>
            ENTRER UN MOIS : <br>
            <input type="text" name="m"><br>
            ENTRER UNE ANNEE : <br>
            <input type="text" name="y"><br>

            <input type="submit" name="SOUMETTRE" value="SOUMETTRE">
        </form>
    </center>
</body>
</html>

<?php

if(isset($_POST["SOUMETTRE"])) {
    $d = (int)$_POST["d"];
    $m = (int) $_POST["m"];
    $y = (int) $_POST["y"];

    $valid = true;

    if ($m < 1 || $m > 12) {
        $valid = false;
    } elseif($m == 2 && $d < 29) {
        $valid = false;
    } elseif (($m == 4 || $m == 6 || $m == 9 || $m == 11) && $d > 30) {
        $valid = false;
    } elseif($d < 1 || $d > 31) {
        $valid = false;
    }

    $message = $valid ? "Date valide" : "Date invalide";
    
    session_start();
    $_SESSION["resultat"] = $message;
    header("Location: date.php");
    exit;

    if ($valid) {
        printf("Date valide");
    } else {
        printf("Date invalide");
    }

    return 0;
}

session_start();
if (isset($_SESSION["resultat"])) {
    echo $_SESSION["resultat"];
    unset($_SESSION["resultat"]);
}