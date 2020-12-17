<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 15 Display</title>
</head>
<body>
    <h1>Profil</h1>

    <?php
        include 'menu.php';
    ?>

<?php

// si l'array 'user' existe en session existe ( ce qui revient à dire que l'utilisateur est connécté, on affiche une phrase de bienvenu à l'utilisateur, sinon , message invitant à la connexion) juste remplacer les élément par $_SESSION['user']
            if(isset($_SESSION['firstname']) && isset($_SESSION['lastname'])){
                    echo 'Bienvenue' . $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] . '!';
                }else {
                    echo 'merci de vous rendre sur la page de connexion';
                }
    ?>
</body>
</html>