<?php

require 'core/functions.php';

mustBeNotConnected();

// appel des variables
if(
    isset($_POST['email']) &&
    isset($_POST['password']) &&
    isset($_POST['confirm-password']) &&
    isset($_POST['pseudonym']) &&
    isset($_POST['g-recaptcha-response'])
){
    // bloc de vérifs
    if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $errors[] = 'Email invalide !';
    }

    if(!preg_match('/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[ !"#\$%&\'()*+,\-.\/:;<=>?@[\\\\\]\^_`{\|}~]).{8,4096}$/', $_POST['password'])){
        $errors[] = 'Le mot de passe doit contenir au moins 8 caractères dont une minuscule, une majuscule, un chiffre et un caractère spécial !';
    }

    if($_POST['password'] != $_POST['confirm-password']){
        $errors[] = 'La confirmation ne correspond pas au mot de passe !';
    }

    if (mb_strlen($_POST['pseudonym']) < 2 || mb_strlen($_POST['pseudonym']) > 50){
        $errors[] = 'Le pseudo est invalide !';
    }
    if(!recaptchaValid($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR'])){
        $errors[] = 'Veuillez remplir le capatcha !';
    }

    if(!isset($errors)){

        $bdd = connectDB();

        // Pour vérifier si le compte existe, il suffit de faire un select avl'email
        $verifUser = $bdd->prepare('SELECT * FROM users WHERE email = ?');
        $verifUser->execute([
            $_POST['email']
        ]);

        $verifUserInfos = $verifUser->fetch();

        // Si $account n'est pas vide, ça veux dire qu'un compte a été trouvé, donc message d'erreur
        if(!empty($verifUserInfos)){
            $errors[] = 'Cette adresse email est déjà prise, veuillez en mettre une autre !';
        }

        if(!isset($errors)){

            // creation du compte
            $createUser = $bdd->prepare('INSERT INTO users(email, password, pseudonym, register_date) VALUES(?, ?, ?, ?)');

            // Execution de la requête
            $statut = $createUser->execute([
                $_POST['email'],
                password_hash($_POST['password'], PASSWORD_BCRYPT),
                $_POST['pseudonym'],
                date('Y-m-d H:i:s')
            ]);

            if($statut){
                $success = " votre compte a bien été céé !";
            } else {
                $errors[] = " il y a eu un problème lors de la création du compte, veuillez réessayer plus tard";
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
    <title>Inscription - Wikifruit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
    <?php include 'core/partials/topmenu.php'; ?>

    <div class="container-fluid">

        <div class="row">

            <div class="col-12 col-md-8 offset-md-2 py-5">
                <h1 class="pb-4 text-center">Créer un compte sur Wikifruit</h1>
                <form action="register.php" method="POST" class="col-12 col-md-6 offset-md-3">

                <?php
                    
                    if(isset($errors)){
                        foreach($errors as $error){
                            echo '<p class="alert alert-danger">' . $error . '</p>';
                        }
                    }
                    
                    if(isset($success)){
                            echo '<p class="alert alert-success">' . $success . '</p>';
                        }
                    ?>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="text" name="email" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input id="password" type="password" name="password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirmation mot de passe</label>
                        <input id="confirm-password" type="password" name="confirm-password" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="pseudonym" class="form-label">Pseudonyme</label>
                        <input id="pseudonym" type="text" name="pseudonym" class="form-control">
                    </div>
                    <div class="mb-3">
                        <p class="mb-2">Captcha</p>
                        <div class="g-recaptcha" data-sitekey="6LftLSAaAAAAAGBGBlBcHDoAxLPICCXfiIxC0rYy"></div>
                    </div>
                    <div>
                        <input value="Créer mon compte" type="submit" class="btn btn-success col-12">
                    </div>

                </form>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"></script>
</body>
</html>