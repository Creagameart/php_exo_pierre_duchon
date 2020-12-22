<?php

// Destinataire
$mail = 'Jeandaniel@gmail.com';

// Objet du mail
$sujet = "Mangez des flans !";

// Message du mail en version texte et en version HTML
$message_txt = "Flanby !";
$message_html = "<html><head></head><body><strong>Pouet.</strong></body></html>";

$crlf = "\r\n";
$boundary = "-----=".md5(rand());

// Nom, prénom et adresse email de l'expediteur (souvent noreply@monsite.fr )
$header = "From: \"monsite.fr\"<noreply@monsite.fr>".$crlf;

// Nom, prénom et adresse email de la personne en retour de réponse de mail
$header.= "Reply-to: \"monsite.fr\" <contact@monsite.fr>".$crlf;
$header.= "MIME-Version: 1.0".$crlf;
$header.= "Content-Type: multipart/alternative;".$crlf." boundary=\"$boundary\"".$crlf;
$message = $crlf."--".$boundary.$crlf;
$message.= "Content-Type: text/plain; charset=\"UTF-8\"".$crlf;
$message.= "Content-Transfer-Encoding: 8bit".$crlf;
$message.= $crlf.$message_txt.$crlf;
$message.= $crlf."--".$boundary.$crlf;
$message.= "Content-Type: text/html; charset=\"UTF-8\"".$crlf;
$message.= "Content-Transfer-Encoding: 8bit".$crlf;
$message.= $crlf.$message_html.$crlf;
$message.= $crlf."--".$boundary."--".$crlf;
$message.= $crlf."--".$boundary."--".$crlf;
mail($mail,$sujet,$message,$header);
?>