<?php
            $firstName = ['Gwendoline', 'Fauve', 'Nicolas', 'Bruno', 'Marie', 'Myriam', 'Pierre',   'Matthieu',  'Gaston', 'Ferdinand', 'André', 'Camille'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 6</title>
</head>
<body>
    <ul>
        <?php


// on recupere la taille du tableau avec count()
        $arrayLength = count($firstName);
        for ($i = 0; $i < $arrayLength; $i++){

            // On boucle autant de fois qu'il y a d'éléments dans l'array $names (avec count pour compter l'array)
            //for ($i = 0; $i < count($firstName); $i++){ methode 1 mais sans $arrayLength
            //for ($i = 0; $i < 10; $i++){ si afficher un nombre précis de nom

                echo '<li>'.$firstName[$i].'</li>';
            }
        ?>
    </ul>
</body>
</html>