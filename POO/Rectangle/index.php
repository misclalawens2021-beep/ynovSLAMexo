<?php
require_once("rectangle_class.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Formulaire</title>
</head>
<body>
	<center>
		<form method="POST">
			longueur : <br>
			<input type="text" name="lg"> <br>

			largeur : <br>
			<input type="text" name="lr"> <br>

			<input type="submit" name="Calculer" value="Calculer">
		</form>
	</center>
</body>
</html>
<?php 

if (isset($_POST["Calculer"])) {
	// Instanciation classe Rectangle
	$unRectangle = new Rectangle();

	// Saisie données
	$unRectangle -> saisir ($_POST);

	// affichage côtés
	echo $unRectangle->afficher();

	// affichage surface
	echo "<br> La surface est de : " . $unRectangle->surface();

	// affichage perimetre 
	echo "<br>Le périmètre est de : " . $unRectangle->perimetre();
}