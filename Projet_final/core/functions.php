<?php

// Ce fichier contient toutes les fonctions nécessaires pour le site. Il doit être inclut sur toutes les pages.

// Pour que toutes les pages puissent travailler avec les variables de session
session_start();

// Fonction permettant de vérifier un captcha Google
function recaptchaValid($code, $ip = null)
{
    if(empty($code)) {
        return false;
    }
    $params = [
        'secret'    => '6LftLSAaAAAAAEVfr304G-W6wDZ8rH31_8ZkCpm6',
        'response'  => $code
    ];
    if($ip){
        $params['remoteip'] = $ip;
    }
    $url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
    if(function_exists('curl_version')){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);
    }else{
        $response = file_get_contents($url);
    }
    if(empty($response) || is_null($response)){
        return false;
    }
    $json = json_decode($response);
    return $json->success;
}

// fonction permettant de retourner une connexion a la bdd
function connectDB(){

    try{
        $bdd = new PDO('mysql:host=localhost;dbname=php_final_project;charset=utf8', 'root', '');

        // TODO : pnser que le site est fini à commenter ou enelver cette ligne de code
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(Exception $e){
        die('Problème avec la base de données : ' . $e->getMessage());
    }

    return $bdd;
}

// fonction permettant de tester si l'utilisateur est connécté ( true si ou, false si non)
function isConnected(){
    return isset($_SESSION['user']);
}

// fonction permettant de bloquer une page si l'utilisateur est déjà connécté
function mustBeNotConnected(){

    // si $_SESSION['user] existe, alors l'utilisateur est connecté
    if(isConnected()){
        header('HTTP/1.0 403 Forbidden');
        require 'core/layouts/alreadyConnected.php';
        die(); // empeche le reste de la page initiale de charger
    }
}
// fonction permettant de bloquer une page si l'utilisateur est déjà connécté
function mustBeConnected(){
    
    // si $_SESSION['user] n'existe pas, alors l'utilisateur n'est pas connecté
    if(!isConnected()){
        header('HTTP/1.0 403 Forbidden');
        require 'core/layouts/notConnected.php';
        die(); // empeche le reste de la page initiale de charger
    }
}

// fonction qui permettra d'afficher la classe css 'active' sur un lien du menu uniquement si $pageToTest contient le nom de la page actuelle
function setActiveIfPageIs($pageToTest){

        // On récupère le nom de la page actuelle via la fonction basename (https://www.php.net/manual/fr/function.basename.php)
    $currentPage = basename($_SERVER['PHP_SELF']);

    if($currentPage == $pageToTest){
        echo ' active';
    }
}

$fruitCountries = [
    'fr' => 'france',
    'en' => 'angleterre',
];