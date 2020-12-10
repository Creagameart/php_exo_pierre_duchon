<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exo 5</title>
</head>
<body>
    <ul>
        <?php

            for ($i = 0; $i < 5000; $i++){

                // Au lieu d'afficher $i qui aura toujours 1 de retard, on affiche $i + 1 pour corriger ce décalage
                echo '<li>'.($i + 1).'</li>';
            }
        ?>
    </ul>
</body>
</html>