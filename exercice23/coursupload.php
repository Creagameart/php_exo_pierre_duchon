<?php
echo '<pre>'
print_r($_FILES);

if(isset($_FILES['photo'])){
    $mauvaisTypeMIME = $_FILES['photo']['type']
    echo 

    $bonTypeMIME = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $_FILES['photo']['tmp_name']);

    echo

    move_uploaded_file($_FILES['photo']['tmp_name'], 'images/exemple.jpg');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cours fichier upload</title>
</head>
<body>


    <form action="index.php" method="POST" enctype="multipart/form-data" >
    
    <input type="hidden" name="MAX_FILE_SIZE" value="2048000">
    <input type="file" name="photo" accept="image/jpeg, image/png">
    <input type="text" name="email">
    <input type="submit">
    
    </form>
</body>
</html>