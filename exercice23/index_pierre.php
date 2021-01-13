<?php

// 1ère étape : Appel des variables 
if (
    isset($_POST['email']) &&
    isset($_FILES['photo'])
){

    $fileErrorCode = $_FILES['photo']['error'];

    // 2ème étape : bloc des vérifs 

            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $errors[] = 'Email invalide !';
            }
            if($fileErrorCode == 1 $fileErrorCode == 2 || $_FILES['photo']['size'] > 5000000){
                $errors[] = 'fichier trop grand!';
            }  else if($fileErrorCode == 3){
                $errors[] = 'fichier non reçu en totalité, veuillez ré-essayer !';
            } else if($fileErrorCode == 4){
                $errors[] = 'Veuilelz choisir une image !';
            } else if($fileErrorCode == 6 || $fileErrorCode == 7 || $fileErrorCode == 8 ){
                $errors[] = 'Problème serveur, veuillez réessayer plus tard!';
            } else if($fileErrorCode != 0 ){
                $errors[] = 'Problème serveur, veuillez réessayer !';
            }

            if(!isset($errors)){

                $allowMIMEType = [
                    'image/jpeg',
                    'image/png',
                    'image/gif',
                ]
                $photMIMEType = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['photo']['tmp_name']);

                if(!in_array($photMIMEType, $allowMIMIType)){
                    $errors[] = 'L\'image doit être un jpg, un png ou un gif !';
                }

                if(!isset($errors)){

                    $newPhotoName = md5( time()) . rand());

                    if ($allowMIMEType == 'image/jpeg'){
                        $newPhotoExt = 'jpg';
                    } else if ($allowMIMEType == 'image/png'){
                        $newPhotoExt = 'png';
                    } else if ($allowMIMEType == 'image/gif'){
                        $newPhotoExt = 'gif';
                    }
                    
                    do{
                        $newPhotoName = md5( time()) . rand()) . '.' . $newPhotoExt;
                    } while(file_exists('images/' . $newPhotoName));

                    move_uploaded_files ($_FILES['photo']['tmp_name'], 'images/' . $newPhotoName);

                    $success = 'l\'image à été bien été téléversé !';
                }
            }
        }


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 23</title>
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
            <form action="index.php" method="POST" enctype="multipart/form-data" >

                <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
                <input type="file" name="photo" accept="image/jpeg, image/png, image/gif">
                <input type="text" name="email">
                <input type="submit">

            </form>
        <?php

    }

    ?>

</body>
</html>