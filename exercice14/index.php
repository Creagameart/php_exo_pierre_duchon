<?php
if (
    isset($_POST['color']))
    {
            if(mb_strlen($_POST['color']) < 2 OR mb_strlen($_POST['color']) > 10 ) 
            {
                $error = 'Bad';
            }
            if(!isset($error)){
                $applyColor = '<body style="background-color:' . htmlspecialchars($_POST['color']) .';"></body>';

                setcookie('userColor', htmlspecialchars($_POST['color']), time() + 3600, null, null, false, true);
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
<body>
<?php echo $applyColor ?>
    <form action="index.php" method="POST">
        <input type="color" name="color">
        <input type="submit">
    </form>
</body>
</html>