<?php
    $admin = 'pierre';
    $color = 'red';
    $font = 'bold';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exo 3</title>
    <style>
        h1{
            color : <?php echo $color;?>;
            font-weight: <?php echo $font;?>;
        }
    </style>
</head>
<body>

<?php

if($admin == 'pierre'){
echo 'Bienvenu Pierre, voici le lien pour ton <a href="https://www.artstation.com/creagameart">portfolio</a> ';
}
else {
    echo '<h1>Nope, tu est un intrus, tu mérite le buché !</h1>';
}

?>

</body>
</html>