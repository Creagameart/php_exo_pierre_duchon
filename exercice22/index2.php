<?php

// Récupération du nombre actuel de visite
$visits = file_get_content('compteur.txt')

//Augmentation du nombre de visite de 1
$visits++;
// Sauvegard du nouveau nombre dans le fichier compteur.txt
file_put_contents('compteur.txt', $visits);

// encore plus simpla :
// supprimer $visits++
// et mettre file_put_contents('compteur.txt', ++$visits);
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