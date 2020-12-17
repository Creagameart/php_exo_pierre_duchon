<?php
session_start();

if(isset($_SESSION['firstname']) && isset($_SESSION['lastname'])){
    $error = 'vous etes déjà conecté';
} else {

    $_SESSION['firstname'] = 'Jean';
    $_SESSION['lastname'] = 'Valjean';

    // or $_SESSION['user'] = [
        // 'firstname' => 'Alice'
        // 'lastname' => 'Durand'
    //]
    // On peut remplacer avec ce tableau, les élément en ligne 4 pour ne mettre que $_SESSION['user'] pour gain de place.

    $success = 'vous etes connecté';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 15 Create</title>
</head>
<body>
    <h1>Connexion</h1>

    <?php
        include 'menu.php';
    ?>

    <?php
            if(isset($success)){
                echo $success;
            }else {
                echo $error;
            }


    ?>

</body>
</html>