<?php
// Exercice 10-a : Afficher la date avec la fonction 


//echo date('l d F Y, H\h i\m s\s', time())


// Exercice 10-b : chercher a afficher la date avec strftime en français

//setlocale(LC_ALL, 'fr_FR', 'fra');
//echo utf8_encode(strftime('%A %d %B %Y, %Hh %Mm %Ss')); // pour windows et le problème d'accent

//echo strftime('%A %d %B %G, %Hh %Mm %Ss'); // pour linux

//$currentDate = date('de-m-Y H:i:s');

//echo $currentDate;

// exo 10-c

// echo date ('Y-m-d H:i:s', time() + (26*24*3600) + (16*3600)); 


//exo 10-4 : creer une variable contenant cette date précise textuelle : "2004-04-16 12:00:00" . Le but est d'ajouter 435 jours à cette date puis de l'afficher sous le format suivant : "samedi 25 juin 2005, 06h 00m 00s"


$dateToTransform = '2004-04-16 12:00:00';


     setlocale(LC_ALL, 'fr_FR', 'fra');
     echo utf8_encode(strftime('%A %d %B %Y, %Hh %Mm %Ss', strtotime($dateToTransform) + (435*24*3600)));

    //echo date ('Y-m-d H:i:s', time($dateToTransform) + (435*24*3600)); 
    //setlocale(LC_ALL, 'fr_FR', 'fra');
    //echo utf8_encode(strftime('%A %d %B %Y, %Hh %Mm %Ss'));
    //setlocale(LC_ALL, 'fr_FR', 'fra');
    //echo utf8_encode(strftime('%A %d %B %Y, %Hh %Mm %Ss', 1082109600));




    //echo date ('Y-m-d H:i:s', 1082109600);


    //echo strtotime('2004-04-16 12:00:00'); //1082109600 


    //echo date ('Y-m-d H:i:s', time($dateToTransform) + (435*24*3600)); 



//echo date ('Y-m-d H:i:s', time() + (26*24*3600) + (16*3600));

//$dateToTransform = '2004-04-16 12:00:00';


?>

