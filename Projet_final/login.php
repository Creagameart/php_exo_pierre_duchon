<?php

// Inclusion du fichier des fonctions
require 'core/functions.php';

mustBeNotConnected();

// appel des variables
if(
    isset($_POST['email']) &&
    isset($_POST['password']) 
){
    // bloc de vérifs
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email invalide !';
    }

    if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !"#\$%&\'()*+,\-.\/:;<=>?@[\\\\\]\^_`{\|}~]).{8,4096}$/', $_POST['password'])){
        $errors[] = 'Le mot de passe doit contenir au moins 8 caractères dont une minuscule, une majuscule, un chiffre et un caractère spécial !';
    }

    if(!isset($errors)){

        // connection à la bdd
        $bdd = connectDB();

        // Pour vérifier si le compte existe, il suffit de faire un select avl'email
        $getUser = $bdd->prepare('SELECT * FROM users WHERE email = ?');
        $getUser->execute([
            $_POST['email']
        ]);

        $userInfos = $getUser->fetch(PDO::FETCH_ASSOC);

        if(empty($userInfos)){
            $errors[] = 'ce compte n\'existe pas!';
        } else {
            if(!password_verify($_POST['password'], $userInfos['password'])){
                $errors[] = " Le mot de passe n'est pas bon !";
            } else {

                $_SESSION['user'] = $userInfos;

                $success = 'Vous êtes bien connécté !';
            }
        }
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Wikifruit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>
    <?php include 'core/partials/topmenu.php'; ?>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12 col-md-8 offset-md-2 py-5">
                <h1 class="pb-4 text-center">Connexion</h1>
                <form action="login.php" method="POST" class="col-12 col-md-6 offset-md-3">

                    <?php
                    if(isset($errors)){
                        foreach($errors as $error){
                            echo '<p class="alert alert-danger">' . $error . '</p>';
                        }
                    }

                    if(isset($success)){
                        echo '<p class="alert alert-success">' . $success . '</p>';
                    } else {
                        ?>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="text" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input id="password" type="password" name="password" class="form-control">
                        </div>
                        <div>
                            <input value="Connexion" type="submit" class="btn btn-primary col-12">
                        </div>

                        <?php
                    }
                    ?>

                </form>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
</body>
</html>