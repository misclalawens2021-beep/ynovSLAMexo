<?php
    require_once("nombre_class.php"); 
?>
<!DOCTYPE html>
<html>
<head>
    <title>nombre</title>
</head>
<body>
<center>
    <h1> Classe Nombre en PHP </h1>
    <form method="post">
        Veuillez saisir un entier : <br>
        <input type="text" name="nb"> <br> <br> 
        <input type="submit" name="mesDiviseurs" value="mesDiviseurs">
        <input type="submit" name="maTable" value="maTable">
        <input type="submit" name="factoriel" value="factoriel">
        <input type="submit" name="fibonacci" value="fibonacci">
    </form>
    <?php
    if (isset($_POST['mesDiviseurs'])){
        $unNombre = new Nombre (); 
        $unNombre->saisir($_POST); 
        echo "<br> Votre nombre est :".$unNombre->afficher();
        echo $unNombre->mesDiviseurs();
    }
    else if (isset($_POST['maTable'])){
        $unNombre = new Nombre (); 
        $unNombre->saisir($_POST); 
        echo "<br> Votre nombre est :".$unNombre->afficher();
        echo $unNombre->maTable();
    }
    else if (isset($_POST['factoriel'])){
        $unNombre = new Nombre (); 
        $unNombre->saisir($_POST); 
        echo "<br> Votre nombre est :".$unNombre->afficher();
        echo $unNombre->factoriel();
    }
    else if (isset($_POST['fibonacci'])){
        $unNombre = new Nombre (); 
        $unNombre->saisir($_POST); 
        echo "<br> Votre nombre est :".$unNombre->afficher();
        echo $unNombre->fibonacci();
    }
    ?>

</center>
</body>
</html>