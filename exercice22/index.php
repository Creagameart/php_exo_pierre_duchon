<?php

// Connexion au fichier
$myFile = fopen('compteur.txt', 'r+');

// Récupération du nombre actuel de visite
$visits = fread($myFile, 12);

//Augmentation du nombre de visite de 1
$visits++;

// replacment du curseur PHP au debut du fichier (pour écrire par dessus l'ancien number)
fseek($myFile, 0);

// Ecriture du nouveau nombre dans le fichier à la place de l'ancien
fwrite($myFile, $visits);

// Fermeture de la connexion
fclose($myFile);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<p>Cette page à été vue <?php echo $visits; ?> fois</p>

</body>
</html>