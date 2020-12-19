<?php

// Tentaiv de connexion à la base de données
try{
    $bdd = new PDO('mysql:host=localhost;dbname=cours;charset=utf8', 'root', '');
// affiche les erreurs SQL qui ne s'afichent pas ( a utiliser pendant le developpement et a retirer quand terlminer)
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(Exception $e){
    // Si la connexion à échouée, le die() stop la page et affiche un message
    die('probleme avec la base de données : ' . $e->getMessage());
}

$response = $bdd->query('SELECT * FROM fruits');

// OR


//$response = $bdd->prepare("SELECT * FROM fruits WHERE color = ?");

$response->execute([
    $_GET['color']

]);

var_dump($response->rowCount()); // recupere le nombre de ligne impacté par la derniere reqeute dans la base de donnée


$fruits = $response->fetch(PDO::FETCH_ASSOC);

$response->closeCursor();

echo '<pre>';
print_r($fruits);
echo '</pre>';

echo 'la couleur du fruit ' . $fruits['name'] . ' est ' . $fruits['color'];

//echo md5('chat');
//echo shawan 

$password = 'chat';

$passwordHashed = echo password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);

if (password_verify('chat', $passwordHashed)){
    echo 'oui';
} else {
    echo'non';
}
//60 caracteres, à chaque fois

// nombre de chaine de texte existante : une infinité

// Nombre d'empreinte md5 possible 16^32 caractères = 3.4 x 10^38
?>