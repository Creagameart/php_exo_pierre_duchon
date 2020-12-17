<?php
// Par défaut, on assigne la couleur grise à $newColor pour éviter d'avoir une couleur vide dans les cas où il n'y a pas de formulaire ou autre.
$newColor = 'grey';

// Si le cookie de sauvegarde de la couleur existe, $newColor prendra la couleur stockée dedans
if(isset($_COOKIE['backgroundColor'])){
    $newColor = $_COOKIE['backgroundColor'];
}
// conditions ternaire ( même chose que les 4 lignes du dessus)
//$newColor= (isset($_COOKIE['backgroundColor'])) ? $_COOKIE['backgroundColor'] : 'grey';


// Appel des variabless
if (
    isset($_POST['color']))
    {
        // bloc de verifs
            if(mb_strlen($_POST['color']) < 2 OR mb_strlen($_POST['color']) > 10 )
            {
                $error = 'Bad'; // si une seul variable, pas besoin des crochets [] car un seul element donc pas besoin d'un array
            }
            // si pas d'erreurs
            if(!isset($error)){
                $newColor = $_POST['color'];
                // on crée un nouveau cookie avec la nouvelle couleur
                setcookie('backgroundColor', ($_POST['color']), time() + 24 * 3600, null, null, false, true);
            }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exo 14</title>
</head>
<body style="background-color:<?php echo htmlspecialchars($newColor) // Definir la couleur et la variable dans le body ?>;">

    <form action="index.php" method="POST">
        <input type="text" name="color">
        <input type="submit">
    </form>

    <?php
    // si erreur de couleur, message d'erreur
        if(isset($error)){
            echo $error;        }
    ?>

</body>
</html>