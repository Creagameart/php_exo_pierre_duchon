<?php
// inclusion du fichier des fonctions
require 'core/functions.php';

//Appel des variables
if(
    isset($_POST['titre']) &&
    isset($_POST['adresse']) &&
    isset($_POST['ville']) &&
    isset($_POST['code_postal']) &&
    isset($_POST['surface']) &&
    isset($_POST['prix']) &&
    isset($_FILES['photo']) &&
    isset($_POST['description'])
){

    // bloc de vérifs
    if (mb_strlen($_POST['titre']) < 10 || mb_strlen($_POST['titre']) > 50){
        $errors[] = 'Le titre doit être compris en 10 à 50 caractères !';
    }

    if (mb_strlen($_POST['adresse']) < 10 || mb_strlen($_POST['adresse']) > 50){
        $errors[] = 'L\'adresse doit être compris en 10 à 50 caractères !';
    }

    if (mb_strlen($_POST['ville']) < 10 || mb_strlen($_POST['ville']) > 50){
        $errors[] = 'La ville doit être compris en 10 à 50 caractères !';
    }
    if (!preg_match('/^[0-9]{1,5}$/', $_POST['code_postal'])){
        $errors[] = 'Prix non compris!';
    }
    if (!preg_match('/^[0-9]{1,4}$/', $_POST['surface'])){
        $errors[] = 'Prix non compris!';
    }
    if (!preg_match('/^[0-9]{1,8}$/', $_POST['prix'])){
        $errors[] = 'Prix non compris!';
    }
    // Verif photo
    if($fileErrorCode == 1 || $fileErrorCode == 2 || $_FILES['photo']['size'] > 5000000){
        $errors[] = 'Fichier trop grand !';
    }else if($fileErrorCode == 3){
        $errors[] = 'Fichier non reçu en totalité, veuillez ré-essayer';
    }else if($fileErrorCode == 4){
        $errors[] = 'Veuillez choisir une image !';
    }else if($fileErrorCode == 6 || $fileErrorCode == 7 || $fileErrorCode == 8){
        $errors[] = 'Problème serveur, veuillez ré-essayer plus tard';
    }else if($fileErrorCode != 0){
        $errors[] = 'Problème, veuillez ré-essayer';
    }

    if (!array_key_exists($_POST['type'], $sellOrRents)){
        $errors[] = 'Le pays est invalide !';
    }

    if (mb_strlen($_POST['description']) < 5 || mb_strlen($_POST['description']) > 20000){
        $errors[] = 'Le nom doit être compris en 5 à 20000 caractères !';
    }

    // Si pas d'erreurs
    if(!isset($errors)){

        $bdd = connectDb();

        $allowedMIMEType = [
            'image/jpeg',
            'image/png',
            'image/gif',
        ];

        $photoMIMEType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['photo']['tmp_name']);

        if(!in_array($photoMIMEType, $allowedMIMEType)){
            $errors[] = 'L\'image doit être un jpg, un png ou un gif !';
        }

        if(!isset($errors)){

            if($photoMIMEType == 'image/jpeg'){
                $newPhotoExt = 'jpg';
            } else if($photoMIMEType == 'image/png'){
                $newPhotoExt = 'png';
            } else if($photoMIMEType == 'image/gif'){
                $newPhotoExt = 'gif';
            }

            do{
                $newPhotoName = md5( time() . rand() ) . '.' . $newPhotoExt;
            } while(file_exists('images/' . $newPhotoName));

            move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $newPhotoName);

            $success = 'Votre image a bien été envoyée !';

        }


        $insertFruit = $bdd->prepare('INSERT INTO logements(titre, adresse, ville, code_postale, surface, prix, photo, type, description) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?,)');

        $statut = $insertFruit->execute([
            $_POST['titre'],
            $_POST['adresse'],
            $_POST['ville'],
            $_POST['code_postale'],
            $_POST['surface'],
            $_POST['prix'],
            $_FILES['photo'],
            $_POST['description']
        ]);

        if($statut){
            $success = " Le logement à bien été ajouté !";
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
    <title>Ajouter un logement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

</head>
<body>
<?php include 'core/partials/topmenu.php'?>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-md-8 offset-md-2 py-5">
                        <h1 class="pb-4 text-center">Veuillez ajouter un logement</h1>
                        <form action="addplace.php" method="POST" enctype="multipart/form-data" class="col-12 col-md-6 offset-md-3 ">

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
                                <label for="name" class="form-label">Titre</label>
                                <input placeholder="Titre" id="name" type="text" name="name"class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Adresse</label>
                                <input placeholder="Adresse" id="name" type="text" name="name"class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Ville</label>
                                <input placeholder="Ville" id="name" type="text" name="name"class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Code postal</label>
                                <input placeholder="Code postal" id="name" type="text" name="name"class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Surface</label>
                                <input placeholder="Surface" id="name" type="text" name="name"class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Prix</label>
                                <input placeholder="Prix" id="name" type="text" name="name"class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Photo</label>
                                <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                                <input type="file" name="photo" accept="image/jpeg, image/png, image/gif">
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select id="type" required name="type" class="form-select">
                                <option selected disabled>vente ou location</option>
                                <?php
                                    foreach($sellOrRents as $key => $sellOrRent){
                                        echo '<option value="' . $key . '">' . ucfirst($sellOrRent) . '</option>';
                                    }
                                 ?>
                                </select>
                                </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="description" cols="30"rows="10" placeholder="Description..."></textarea>
                                    </div>
                                <div>
                                <input value="Ajouter le logement" type="submit" class="btn btn-primary col-12">
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