<?php

// 1ère étape : Appel des variables (1 champ de formulaire = 1 isset) : consiste à vérifier si TOUTES les variables du formulaire existe
if(
    isset($_POST['email']) &&
    isset($_POST['age']) &&
    isset($_POST['favwebsite'])
){


    // 2ème étape : bloc des vérifs (1 champ = 1 structure conditionnelle) : consiste pour chaque champ à vérifier qu'il contient bien des données valides

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email invalide !';
        }

        if (!filter_var($_POST['url'], FILTER_VALIDATE_URL)){
        $errors[] = 'Adresse web invalide !';
        }

        if (!filter_var($_POST['age'], FILTER_VALIDATE_INT || $_POST['age'] > 150|| $_POST['age'] < 0)){
        $errors[] = 'Age invalide !';
        }


    // 3ème étape : si le formulaire n'a pas d'erreur, on fait les actions post-formulaire
    if(!isset($errors)){

        // Création du message de succès
        $success = 'vos données sont correctes';
    }

}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 16</title>
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
    if(isset($success)){

        echo '<p style="color:green;">' . $success . '</p>';

    } else {

        ?>
            <form action="index.php" method="POST">
                <input type="text" placeholder="Mail" name="email">
                <input type="text" placeholder="Age" name="age">
                <input type="text" placeholder="Site favoris" name="url">
                <input type="submit">
            </form>
        <?php

    }

    ?>

</body>
</html>