<?php
// Exercice 10-a : Afficher la date avec la fonction 


//echo date('l d F Y, H\h i\m s\s')


// Exercice 10-b : chercher a afficher la date avec strftime en français
setlocale(LC_ALL, 'fr_FR');
echo strftime('%A %d %B %G, %Hh %Mm %Ss');
?>