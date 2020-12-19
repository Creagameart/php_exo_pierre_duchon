<?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
// affiche les erreurs SQL qui ne s'afichent pas ( a utiliser pendant le developpement et a retirer quand terlminer)
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(Exception $e){
    // Si la connexion à échouée, le die() stop la page et affiche un message
    die('probleme avec la base de données : ' . $e->getMessage());
}

if(isset($_GET['color'])){


    // avec variable et concatenation, on utilise prepare
    $response = $bdd->prepare("SELECT * FROM fruits WHERE color = ?");
    $response->execute([
        $_GET['color']
    ]);

} else {

    // requete pour récuperer tout les fruits ( requete directe sans variable, c'est query )
    $response = $bdd->query("SELECT * FROM fruits");

}
// recuperation des fruits sous forme d'array
$fruits = $response->fetchAll(PDO::FETCH_ASSOC);
// Fermeture requête
$response->closeCursor();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exo 18</title>
</head>
<body>

    <form action="index.php" method="GET">
        <input type="text" placeholder="couleur" name="color">
        <input type="submit">
    </form>
<?php

if(!empty($fruits)){
    echo '<ul>';
    foreach ($fruits as $fruit){
        echo '<li>' . htmlspecialchars($fruit['name']) . ' ' . htmlspecialchars($fruit['color']) . '</li>';
    }
    echo '</ul>';
} else {
    echo '<p> Aucun fruit à afficher ! </p>';
}

?>



</body>
</html>