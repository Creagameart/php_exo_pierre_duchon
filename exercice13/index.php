<?php
// correction

// etape 1 : Appel des variable
 if (
    isset($_POST['firstname']) &&
    isset($_POST['lastname']) &&
    isset($_POST['age']) 
    ){
       
      // étape 2 : bloc de vérification ( 1 champ = 1 structure conditionnelle)
            if(mb_strlen($_POST['firstname']) > 50 OR mb_strlen($_POST['firstname']) < 2) {
                $errors[] = 'prénom pas bon';}

            if(mb_strlen($_POST['lastname']) > 50 OR mb_strlen($_POST['lastname']) < 2) {
                $errors[] = 'nom pas bon';}

            if(!is_numeric($_POST['age']) || ($_POST['age'] > 150 OR $_POST['age'] < 0) !ctype_digits($_POST['age'])) {
                $errors[] = 'age pas bon';}

                    //// UN POINT D'EXCLAMATION A ETE AJOUTE AVANT LE "is_numeric", IL PERMET DE METTRE EN FALSE SI LE INPUT EST DIFFERENT D'UN NUMERIC, CELA REND LE CODE PLUS PROPRE, PAREIL POUR LES AUTRES BOOLEAN///
                    //}

                    // 3eme etapes : si le formulaire n'a pas d'erreur, on fait les actions post-formulaires
            if(!isset($errors)){
                $successMsg = 'Bienvenue' . htmlspecialchars($_POST['firstname']) .' '.htmlspecialchars($_POST['lastname']). ', tu a ' .htmlspecialchars($_POST['age']). '!';
                    }
                }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exo 13 index</title>
</head>
<body>
    <h2>Formulaire à remplir</h2>

<?php
// correction 

// si l'array $errors existe, alors on le parcours avec un foreach et on affiche les erreurs quil contient
if(isset($errors)){
    foreach($errors as $error){
        echo '<p style="color:red;">'. $error . '</p>';
    }
}

// si la variable $successMsg exists, alors on l'affiche, sinon on affiche le formulaire dans le else
if(isset($succssMsg)){

    echo '<p style="color:green;">'. $successMsg . '</p>';
} else {

    ?>
    <form action="index.php" method="POST">
        <input placeholder="Prénom" type="text" name="firstname">
        <input placeholder="Nom" type="text" name="lastname">
        <input placeholder="Age" type="number" name="age">
        <input type="submit">
    </form>

    <?php
}

/// fin correction

?>


    <?php

        if (isset($_POST['firstname'])) {
            if(mb_strlen($_POST['firstname']) > 50 OR mb_strlen($_POST    ['firstname']) < 2) {
                echo 'Veuillez remplir le prénom entre 2 et 50 caractere<br>';
            }
        } else {
        }

        if (isset($_POST['lastname'])) {
            if(mb_strlen($_POST['lastname']) > 50 OR mb_strlen($_POST['lastname'] ) < 2) {
                echo 'Veuillez remplir le nom entre 2 et 50 caractere<br>';
            }
        } else {
        }
        if (isset($_POST['age'])) {
            if(is_numeric($_POST['age'])) {
                if($_POST['age'] > 150 OR $_POST['age'] < 0) {
                echo 'Veuillez remplir l\'àge <br>';
                }
            }
        } else {
        }

        if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['age'])) {
            echo 'Bienvenue' . htmlspecialchars($_POST['firstname']) .' '.htmlspecialchars($_POST['lastname']). ', tu a ' .htmlspecialchars($_POST['age']). '!';
        } else {
        }
    ?>



    <form action="index.php" method="POST">
        <input placeholder="Prénom" type="text" name="firstname">
        <input placeholder="Nom" type="text" name="lastname">
        <input placeholder="Age" type="number" name="age">
        <input type="submit">
    </form>

</body>
</html>