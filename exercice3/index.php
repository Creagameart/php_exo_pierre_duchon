<?php

// création de la variable
    $admin = true;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exo 3</title>
    <style>
        h1{
            color : 'red';
            font-weight: 'bold';
        }
    </style>
</head>
<body>







<?php

// Même si la balise PHP se ferme avant la fermeture du if, le coe HTML déclaré entre sera considéré comme faisant partie de la condition
if($admin) {

    ?>
    echo '<p>Bienvenu Pierre, voici le lien pour ton <a href="https://www.artstation.com/creagameart">portfolio</a></p> ';
    <?php

} else {

    ?>
    <h1>Nope, tu est un intrus, tu mérite le buché !</h1>';
    <?php
}

?>








<?php

if($admin/*si la variable est un booléan, juste mettre la variable sans = true, car la déclaration est déjà en true*/){
echo '<p>Bienvenu Pierre, voici le lien pour ton <a href="https://www.artstation.com/creagameart">portfolio</a></p> ';
}
else {
    echo '<h1>Nope, tu est un intrus, tu mérite le buché !</h1>';
}

?>


</body>
</html>