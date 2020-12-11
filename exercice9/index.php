<?php

// Fonction permettant d'afficher le contenu d'une variable avec un print-r entouré d'une balise html <pre>
    function print_rv2($elementToDisplay){
        echo '<pre>';
        print_r($elementToDisplay); 
        echo '</pre>';
}


// Fonction qui retourne un prix initial additionne avec une taxe précisé en second parametre
function getTTCPrice($htPrice, $tax = 20){
    return $htPrice * (($tax / 100) + 1);

}

$fruits = ['poire', 'pomme', 'fraise'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exo 9</title>
</head>
<body>
    <?php
// Affichage de l'array des fruits avec la ouvelle fonction
        print_rv2($fruits);
// Affichage du prix TTC de 18
        echo getTTCPrice( 18);
    ?>
</body>
</html>