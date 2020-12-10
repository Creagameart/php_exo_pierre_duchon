<?php
$userInfos = [
    'firstName' => 'Peter', 
    'lastName' => 'Bolder', 
    'age' => '42', 
    'country' => 'England', 
    'sexe' => 'M'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exo 7</title>
<style>
        .red{
            color : red;
            font-weight: bold;
        }
</style>

</head>
<body>


    <?php


//echo '<pre>';
//print_r($userInfos); 
//echo '</pre>';

// echo "je suis0 {$userinfo['ifirstName]} " on utilise les accolades dans le texte si on utilise des guimets double. Peu conseillée

echo 'This man name is <span class="red">' . $userInfos['firstName'] . ' </span><span class="red">' . $userInfos['lastName'] . ' </span>he live in ' . $userInfos['country'] . ' is ' . $userInfos['age'] . ' and is ' . $userInfos['sexe'] ;
?>

</body>
</html>