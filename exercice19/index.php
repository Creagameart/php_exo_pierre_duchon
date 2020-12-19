<?php

// partie formulaire  fonctionnel

// 1ère étape : Appel des variables 
if (
    isset($_POST['name']) &&
    isset($_POST['color']) &&
    isset($_POST['origin']) &&
    isset($_POST['price'])
){


    // 2ème étape : bloc des vérifs 


            if (mb_strlen($_POST['name']) < 2 || mb_strlen($_POST['name']) > 25){
                $errors[] = 'Nom de fruit compris entre 2 et 25 caracteres !';
            }
            if (mb_strlen($_POST['color']) < 2 || mb_strlen($_POST['color']) > 25){
                $errors[] = 'Couleur compris entre 2 et 25 caracteres !';
            }

            if (mb_strlen($_POST['origin']) < 2 || mb_strlen($_POST['origin']) > 25){
                $errors[] = 'Origine du pays compris entre 2 et 25 caracteres !';
            }
            // prix composé de 4 chiffres, suivi iptionnellement d'un virgule ou point avec 2 chiffres derriere
            if (!preg_match('/^[0-9]{1,4}([\.,][0-9]{1,2})?$/', $_POST['price'])){
                $errors[] = 'Prix non compris!';
            }


    // 3ème étape :  pas d'erreur, actions post-formulaire
    if(!isset($errors)){


        try{
            $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
        // affiche les erreurs SQL qui ne s'afichent pas ( a utiliser pendant le developpement et a retirer quand terlminer)
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(Exception $e){
            // Si la connexion à échouée, le die() stop la page et affiche un message
            die('probleme avec la base de données : ' . $e->getMessage());
        }

        // requete prearée pour creer le nouveau fruit ( préparée car il y a des variables PHP)
        $response = $bdd->prepare('INSERT INTO fruits(`name`, color, origin, price) VALUES (?, ?, ?, ?)');
        $response->execute([
            $_POST['name'],
            $_POST['color'],
            $_POST['origin'],
            str_replace(',','.',$_POST['price']), // Stockage en bdd du prix avec un point au lieu d'une virgule (sql ne prend que les points pour la virgule)
        ]);
        if($response->rowCount() > 0){
            $success = 'le fruit a bien été créé !';
        } else {
            $errors[] = 'Problème lié au site!';
        }

        // Fermeture requête
        $response->closeCursor();
    }
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 19</title>
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
                <input type="text" placeholder="Nom" name="name">
                <input type="text" placeholder="Couleur" name="color">
                <input type="text" placeholder="Provenance" name="origin">
                <input type="text" placeholder="Prix" name="price">
                <input type="submit">
            </form>
        <?php

    }

    ?>

</body>
</html>