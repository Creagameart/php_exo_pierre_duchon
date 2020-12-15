<?php

// 1ère étape : Appel des variables (1 champ de formulaire = 1 isset) : consiste à vérifier si TOUTES les variables du formulaire existe
if(
    isset($_POST['firstname']) &&
    isset($_POST['lastname']) &&
    isset($_POST['age'])
){


    // 2ème étape : bloc des vérifs (1 champ = 1 structure conditionnelle) : consiste pour chaque champ à vérifier qu'il contient bien des données valides

    if(mb_strlen($_POST['firstname']) < 2 || mb_strlen($_POST['firstname']) > 50){
        $errors[] = 'Prénom pas bon !';
    }

    if(mb_strlen($_POST['lastname']) < 2 || mb_strlen($_POST['lastname']) > 50){
        $errors[] = 'Nom pas bon !';
    }

    if(!is_numeric($_POST['age']) || $_POST['age'] < 0 || $_POST['age'] > 150 || !ctype_digit($_POST['age'])){

        $errors[] = 'Age pas bon !';
    }


    // 3ème étape : si le formulaire n'a pas d'erreur, on fait les actions post-formulaire
    if(!isset($errors)){

        // Création du message de succès en mettant la version protégée des données (sinon faille XSS)
        $successMsg = 'Bonjour ' . htmlspecialchars($_POST['firstname']) . ' ' . htmlspecialchars($_POST['lastname']) . ' , tu as ' . htmlspecialchars($_POST['age']) . ' ans !';
    }

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice 13</title>
</head>
<body>


    <?php

    // Si l'array $errors existe, alors on le parcours avec un foreach et on affiche les erreurs qu'il contient
    if(isset($errors)){
        foreach($errors as $error){
            echo '<p style="color:red;">' . $error . '</p>';
        }
    }

    // Si la variable $successMsg existe, alors on l'affiche, sinon on affiche le formulaire dans le else
    if(isset($successMsg)){

        echo '<p style="color:green;">' . $successMsg . '</p>';

    } else {

        ?>
            <form action="index.php" method="POST">
                <input type="text" placeholder="Prénom" name="firstname">
                <input type="text" placeholder="Nom" name="lastname">
                <input type="text" placeholder="Age" name="age">
                <input type="submit">
            </form>
        <?php

    }

    ?>

</body>
</html>