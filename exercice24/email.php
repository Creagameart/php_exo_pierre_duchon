<?php

// Destinataire
$mail = 'destinataire@exemple.com';

// Objet du mail
$sujet = "Sujet";

// Message du mail en version texte et en version HTML
$message_txt = "Message.";
$message_html = "<html><head></head><body><strong>Message.</strong></body></html>";

$crlf = "\r\n";
$boundary = "-----=".md5(rand());

// Nom, prénom et adresse email de l'expediteur (souvent noreply@monsite.fr )
$header = "From: \"Nom Prénom\"<moi@exemple.com>".$crlf;

// Nom, prénom et adresse email de la personne en retour de réponse de mail
$header.= "Reply-to: \"Nom Prénom\" <moi@exemple.com>".$crlf;
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