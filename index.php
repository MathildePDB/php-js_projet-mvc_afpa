<?php

session_start();

// appeler les fonctions générales
require_once('service/extra.php');

// si aucun utilisateur n'est connecté
if(!$_SESSION){
    $_SESSION['username']='visiteur';
    $_SESSION['roles']='["ROLE_USER"]';
}

// mise en place de l'url
if ($_GET) {
    // index.php?control=article&action=list
    $url = $_GET;
    $nomController = $_GET['control'] . 'Controller';
    $nomController = ucfirst($nomController);
    $fichierController = "controller/$nomController.php";
    // echo "NomController = $nomController </br>";
    // echo "FichierController = $fichierController </br>";
    if (file_exists($fichierController)) {
        $controller = new $nomController($url);
    } else {
        echo "<h3>Le fichier $fichierController n'existe pas.<h3>";
    }
} else {
    // echo "<h3>Vous n'avez pas encore défini un controller !</h3";
    $url = [];
    $controller = new AccueilController($url);
}
