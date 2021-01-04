<?php
// inclusion du fichier des fonctions
require 'core/functions.php';

mustBeConnected();

if(
    isset($_POST['name']) &&
    isset($_POST['origin']) &&
    isset($_POST['description'])
){
    // bloc de vérifs
    if (mb_strlen($_POST['name']) < 2 || mb_strlen($_POST['name']) > 50){
        $errors[] = 'Le nom doit être compris en 1 à 50 caractères !';
    }

    if (!array_key_exists($_POST['origin'], $fruitCountries)){
        $errors[] = 'Le pays est invalide !';
    }

    if (mb_strlen($_POST['description']) < 5 || mb_strlen($_POST['description']) > 20000){
        $errors[] = 'Le nom doit être compris en 5 à 20000 caractères !';
    }

    if(!isset($errors)){

        $bdd = connectDb();

        $insertFruit = $bdd->prepare('INSERT INTO fruits(name, origin, description, user_id) VALUES(?, ?, ?, ?)');

        $statut = $insertFruit->execute([
            $_POST['name'],
            $_POST['origin'],
            $_POST['description'],
            $_SESSION['user']['id']
        ]);

        if($statut){
            $success = " Le fruit à bien été créé !";
        } else {
            $errors[] = " il y a eu un problème lors de la création du fruit, veuillez réessayer plus tard";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un fruit - Wikifruits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>
<body>
<?php include 'core/partials/topmenu.php'?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-8 offset-md-2 py-5">
                    <h1 class="pb-4">Accuil wiki fruits</h1>
                    <form action="addfruit.php" method="POST" class="col-12 col-md-6 offset-md-3">

                <?php
                if(isset($errors)){
                    foreach($errors as $error){
                        echo '<pre class="alert alert-danger">' . $error . '</pre>';
                    }
                }
                
                if(isset($success)){
                    echo '<p class="alert alert-success">' . $success . '</p>';
                } else {
                    ?>
                
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom</label>
                        <input placeholder="Banane" id="name" type="text" name="name"                     class="form-control">
                    </div>
                    <div class="mb-3">
                            <label for="origin" class="form-label">Pays d'origine</label>
                            <select id="origin" required name="origin" class="form-select">
                                <option selected disabled>Sélectionner un pays</option>
                                <?php

                                foreach($fruitCountries as $key => $country){
                                    echo '<option value="' . $key . '">' . ucfirst($country) . '</option>';
                                }

                                ?>
                            </select>
                        </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" cols="30"                      rows="10" placeholder="Description..."></textarea>
                    </div>
                    <div>
                        <input value="Créer le fruit" type="submit" class="btn btn-primary col-12">
                    </div>
                
                    <?php
                }
                ?>
                
                </form>
                    </div>

                </div>

            </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" ></script>

</body>
</html>