<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>exo 12 form</title>
</head>
<body>

<?php
    echo '<pre>';
    print_r($_GET);
    echo '</pre>';

    
?>

<form action="display.php" method="GET">
    <input type="text" name="firstname">
    <input type="email" name="mail">
    <input type="submit">
</form>


</body>
</html>