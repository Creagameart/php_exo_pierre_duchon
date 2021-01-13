<?php

// Ce fichier contient toutes les fonctions nécessaires pour le site. Il doit être inclut sur toutes les pages.

// Pour que toutes les pages puissent travailler avec les variables de session
session_start();

// fonction permettant de retourner une connexion a la bdd
function connectDB(){

    try{
        $bdd = new PDO('mysql:host=localhost;dbname=immobilier;charset=utf8', 'root', '');

        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(Exception $e){
        die('Problème avec la base de données : ' . $e->getMessage());
    }

    return $bdd;
}

// fonction qui permettra d'afficher la classe css 'active' sur un lien du menu uniquement si $pageToTest contient le nom de la page actuelle
function setActiveIfPageIs($pageToTest){

    $currentPage = basename($_SERVER['PHP_SELF']);

    if($currentPage == $pageToTest){
        echo ' active';
    }
}

$sellOrRents = [
    'v' => 'vente',
    'l' => 'location',
];
