<?php


// 1ère étape : Appel des variables 
if (
    isset($_GET['search']) 
){

    // 2ème étape : bloc des vérifs 

        if (mb_strlen($_GET['search']) < 1 || mb_strlen($_GET['search']) > 50){
            $error = 'Invalide';
        }

        // 3ème étape :  pas d'erreur, actions post-formulaire
        if(!isset($error)){

            // connexion à la bdd
            try{
                $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(Exception $e){
                die('probleme avec la base de données : ' . $e->getMessage());
            }


            $searchFruits = $bdd->prepare('SELECT * FROM `fruits` WHERE `name` LIKE ?');
            // methode 2 : $statut = $response->execute([
            $searchFruits->execute([
                '%' . $_GET['search'] . '%'
            ]);

        // recuperation des fruits sous forme d'array
        $fruits = $searchFruits->fetchAll(PDO::FETCH_ASSOC);
        // Fermeture requête
        $searchFruits->closeCursor();

        if(empty($fruits)){

            $error = 'Aucune resultat';
        }
    }
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 21</title>
</head>
<body>

            <form action="index.php" method="GET">
                <input type="text" placeholder="Fruit" name="search">
                <input type="submit">
            </form>

    <?php

        if(isset($error)){
            echo '<p>' . $error . '</p>';
        }


        if(!empty($fruits)){

            echo '<p>' . count($fruits) . '</p>';
    ?>

        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Couleur</th>
                    <th>Origine</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>

                <?php
                    foreach($fruits as $fruit){
                        echo '<tr>';
                        echo '<td>'. htmlspecialchars(ucfirst($fruit['name'])) .'</td>';
                        echo '<td>'. htmlspecialchars($fruit['color']) .'</td>';
                        echo '<td>'. htmlspecialchars(ucfirst($fruit['origin'])) .'</td>';
                        echo '<td>'. htmlspecialchars($fruit['price']) .'€</td>';
                        echo '</tr>';
                    }
                ?>

            </tbody>
        </table>

    <?php
        }

    ?>



</body>
</html>