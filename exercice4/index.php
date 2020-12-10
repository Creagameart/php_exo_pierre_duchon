<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exo 4</title>
</head>
<body>
    <ul>
        <?php

            $i = 0;
// Tant que $i est plus petit que 5000, on boucle
            while ($i <= 5000){
                //$1++; 1ere methode ( enlever le $i++ a la fin)
                echo '<li>'.($i+1).'</li>';
                //echo '<li>'.++$i.'</li>'; (3 eme methode, sans l'echo au dessus et le $i++ en dessous)
                $i++;
            }

        ?>
    </ul>
</body>
</html>