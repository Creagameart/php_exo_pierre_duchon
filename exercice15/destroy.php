<?php
session_start();
session_destroy();

// supprime l'array user dans la session, sans supprimer toute la session comme le ferais session_destroy()
// la suppresion de l'array est en faite une déconnxion de l'utilisateur
// unset($_SESSION['user']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 15 Destroy</title>
</head>
<body>
    <h1>Deconnexion</h1>
<p>La session à été supprimée/deconnécté</p>
    <?php
        include 'menu.php';
    ?>
</body>
</html>