<?php
// création d'un array contenant des utilisateurs avec leurs infos ( les pays sont eux memes des sous sous tableau)
$users = [

            [
                'name' => 'Pierre',
                'nationality' => 'french',
                'yearofbirth' => '1989',
                'countryseen' => ['France', 'italia','Spain'],
            ],
            [
                'name' => 'Laura',
                'nationality' => 'italian',
                'yearofbirth' => '1994',
                'countryseen' => ['Japan'],
            ],
            [
                'name' => 'Yukiko',
                'nationality' => 'japanese',
                'yearofbirth' => '2000',
                'countryseen' => [], //pas de pays visité donc array vide
            ],
            [
                'name' => 'Jade',
                'nationality' => 'english',
                'yearofbirth' => '1997',
                'countryseen' => ['Spain'],
            ],
            [
                'name' => 'David',
                'nationality' => 'canadian',
                'yearofbirth' => '2005',
                'countryseen' => ['italia','Spain'],
            ],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exo 8</title>
</head>
<body>

<?php
// on parcours tout les utilisateurs avec un foreach pour afficher une structure HTML pour chacun d'entre eux
    foreach($users as $user){

    // titre H2 avec le prénom de l'utilisateur
        echo '<h2>'. $user['name'] .'</h2>';

    // idem avec les infos
        echo '<p>Hello, my name is ' . $user['name'] . ', i\'m ' . $user['nationality'] . ' and i am  born in ' . $user['yearofbirth'] . '</p>';
        echo '<p>Liste des pays visités :</p>';


// Si l'utilisateur à visité au moins un pays ( il faut que le tableau des pays  soit d'une taille minimum de 1), alors on affichera ces pays, sinon on ira dans le else pour afficher un message d'erreur
    if ( count($user['countryseen']) > 0 ){

        // ouvertur de la liste à puce
        echo '<ul>';

    // On parcours les pays pours les afficher un par un dans un li
    foreach($user['countryseen'] as $country){
        echo '<li>' . $country . '</li>';

    }
// fermeture de la liste à puce
        echo '</ul>';

    } else {

        echo '<p> Cet utilisateur n\'a pas encore visité de pays';
    }

// trait de séparations
    echo '<hr>';
}


/*
    $arrayLength = count($users);
        for ($i = 0; $i < $arrayLength; $i++){

            echo '<h2>'. $users[$i]['name'] .'</h2>';
            echo '<p>Hello, my name is ' . $users[$i]['name'] . ', i\'m ' . $users[$i]['nationality'] . ' and i am  born in ' . $users[$i]['yearofbirth'] . '</p>';
            }
*/
        //echo '<pre>';
        //print_r($users);
        //echo '</pre>';
?>


</body>
</html>