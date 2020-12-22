<?php


// 1ère étape : Appel des variables 
if (
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['verifPassword'])
){


    // 2ème étape : bloc des vérifs 

            // Pour email
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $errors[] = 'Email invalide !';
            }
            // Pour mot de passe ( entre 8 et 4096 caracteres)
            if (!preg_match('/^.{8,4096}$/', $_POST['password'])){
                $errors[] = 'Mot de passe invalide !';
            }
            // Verification mot de passe
                if ($_POST['password'] != $_POST['verifPassword']) {
                    $errors[] = 'Vérification invalide !';
                }

        // 3ème étape :  pas d'erreur, actions post-formulaire
        if(!isset($errors)){

            // Second bloc de verif ( partie bonus pour verifier si email pas deja pris)

            // connexion à la bdd
            try{
                $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(Exception $e){
                die('probleme avec la base de données : ' . $e->getMessage());
            }
            // pour verifier si le compte existe, il faut faire un SELECT avec l'email
            $checkIfExiste = $bdd->prepare('SELECT * FROM accounts WHERE emmail = ?');

            $response->execute([
                $_POST['email']
            ]);


            $account =$checkIfExiste->fetch(PDD::FETCH_ASSOC);

            // Si $account n'est pas vide, ça veux dire qu'un compte à été trouvé, donc message d'erreur
            if(!empty($account)){
                $errors[] = 'Cette adresse emaol est déjà prise, veuillez en mettre une autre !'
            }
            
        //pas d'erreur,
        if(!isset($errors)){

            // requete preparée pour creer le nouveau compte ( préparée car il y a des variables PHP)
            $response = $bdd->prepare('INSERT INTO accounts(email, `password`, register_date) VALUES (?, ?, ?)');// ou NOW() pour le register_date, mais retiré le date si utilisé
            // methode 2 : $statut = $response->execute([
            $response->execute([
                $_POST['email'],
                password_hash($_POST['password'], PASSWORD_BCRYPT), // on stock le hash du mot de passe
                //$date['Y-F-d H:i:s'],
                date('Y-m-d H:i:s'), // on stock la date actuelle au moment de l'execution
            ]);

            //methode 2 : $statut->closeCursor();

            // methode 2 : if($statu){
            if($response->rowCount() > 0){
                $success = 'le compte a bien été créé !';
            } else {
                $errors[] = 'Problème lié au site!';
            }

            // Fermeture requête
            $response->closeCursor();
        }
    }
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 20</title>
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
            <form action="register.php" method="POST">
                <input type="text" placeholder="Mail" name="email">
                <input type="text" placeholder="Mot de passe" name="password">
                <input type="text" placeholder="Vérification mot de passe" name="verifPassword">
                <input type="submit">
            </form>
        <?php

    }

    ?>

</body>
</html>