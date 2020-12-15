<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 12 display</title>
</head>
<body>
    <h1>je suis la page display</h1>

    <?php
    if (isset($_GET['firstname']) && isset($_GET['mail'])) {
        echo 'Bonjour' . htmlspecialchars($_GET['firstname']) . ', ton adresse mail est ' . $_GET['mail'] . '!';
    } else {
        echo ' Veuillez paser par le formulaire !';
    }
    // htmlspecilachar permet de preotégé des donné d'un echo si piratage via un formulaire et pour les moments des variable sont affiché ou executé.

    ?>
</body>
</html>