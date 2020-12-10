<?php

$users = [

            [
                'name' => 'Pierre',
                'nationality' => 'french',
                'yearofbirth' => '1989'
            ],
            [
                'name' => 'Laura',
                'nationality' => 'italian',
                'yearofbirth' => '1994'
            ],
            [
                'name' => 'Yukiko',
                'nationality' => 'japanese',
                'yearofbirth' => '2000'
            ],
            [
                'name' => 'Jade',
                'nationality' => 'english',
                'yearofbirth' => '1997'
            ],
            [
                'name' => 'David',
                'nationality' => 'canadian',
                'yearofbirth' => '2005'
            ],
        ];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exo 8</title>
</head>
<body>

<?php

    $arrayLength = count($users);
        for ($i = 0; $i < $arrayLength; $i++){

            echo '<h2>'. $users[$i]['name'] .'</h2>';
            echo '<p>Hello, my name is ' . $users[$i]['name'] . ', i\'m ' . $users[$i]['nationality'] . ' and i     am  born in ' . $users[$i]['yearofbirth'] . '</p>';
            }
            
        //echo '<pre>';
        //print_r($users);
        //echo '</pre>';
?>


</body>
</html>