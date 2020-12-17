<?php

// 1ère étape : Appel des variables 
if (
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['birthdate']) &&
    isset($_POST['pseudo'])
){


    // 2ème étape : bloc des vérifs 

        // regex pour email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email invalide !';
        }
        // regex pour mot de passe ( entre 8 et 4096 caracteres)
        if (!preg_match('/^.{8,4096}$/', $_POST['password'])){
        $errors[] = 'Mot de passe invalide !';
        }
        // regex pour date de naissance ( format : dd-mm-yyyy, dd.mm.yyyy, dd/mmyyyy)
        if (!preg_match('/^(?:(?:31(\/|-|\.)(?:0?[13578]|1[02]))\1|(?:(?:29|30)(\/|-|\.)(?:0?[13-9]|1[0-2])\2))(?:(?:1[6-9]|[2-9]\d)?\d{2})$|^(?:29(\/|-|\.)0?2\3(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00))))$|^(?:0?[1-9]|1\d|2[0-8])(\/|-|\.)(?:(?:0?[1-9])|(?:1[0-2]))\4(?:(?:1[6-9]|[2-9]\d)?\d{2})$/', $_POST['birthdate'])){
        $errors[] = 'Date de naissance invalide !';
        }
        // regex pour pseudonymes ( entre 2 et 25 caractères)
        if (!preg_match('/^[a-zA-Z0-9ÀÁÂÃÄÅÇÑñÇçÈÉÊËÌÍÎÏÒÓÔÕÖØÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöøùúûüýÿ]{2,25}$/', $_POST['pseudo'])){
        $errors[] = 'Pseudonyme invalide !';
        }


    // 3ème étape :  pas d'erreur actions post-formulaire
    if(!isset($errors)){

        //  message de succès
        $success = 'Vos données sont enregistrées ! Bienvenue';
    }

}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 17</title>
</head>
<body>


    <?php

    // Si l'array $errors existe, alors on le parcours avec un foreach et on affiche les erreurs qu'il contient
    if(isset($errors)){
        foreach($errors as $error){
            echo '<p style="color:red;">' . $error . '</p>';
        }
    }

    // Si la variable $success existe, alors on l'affiche, sinon on affiche le formulaire dans le else
    if(isset($success)){

        echo '<p style="color:green;">' . $success . '</p>';

    } else {

        ?>
            <form action="index.php" method="POST">
                <input type="text" placeholder="Mail" name="email">
                <input type="text" placeholder="Mot de passe" name="password">
                <input type="text" placeholder="Date de maissance" name="birthdate">
                <input type="text" placeholder="Pseudonymes" name="pseudo">
                <input type="submit">
            </form>
        <?php

    }

    ?>

</body>
</html>