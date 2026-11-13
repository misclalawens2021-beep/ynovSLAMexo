<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equation/algo</title>
</head>
<body>
    <center>
        <h1>
            Exercice Equation
        </h1>
        <form method="POST">
            Premier coeff : <br>
            <input type="text" name="a"><br>
            Deuxième coeff: <br>
            <input type="text" name="b"><br>
            <input type="submit" name="Resoudre" value="Resoudre">
        </form>
        <?php
        
        if (isset($_POST["Résoudre"])) {
            $a = $_POST["a"];
            $b = $_POST["b"];
        }
        
        ?>
    </center>
</body>
</html>