<?php

// Automatiser le chargement d'un fichier d'une classe instanciée 
spl_autoload_register('charger');

function charger($class)
{
    $nomClass = ucfirst($class);

    $fichierModel = "model/$nomClass.php";
    $fichierController = "controller/$nomClass.php";
    $fichierService = "service/$nomClass.php";
    $fichierView = "view/$nomClass.php";

    $fichiers = [$fichierModel, $fichierController, $fichierService, $fichierView];

    foreach ($fichiers as $fichier) {
        if (file_exists($fichier)) {
            require_once($fichier);
        }
    }
}

// affichage des variables tableau

function printr($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

// generer l'affichage de la page

function generate($file, $array = [], $base = "view/base.php")
{
    $page = generatePage($file, $array);
    $content = ['content' => $page];
    echo generatePage($base, $content);
}

function generatePage($file, $array)
{
    if (file_exists($file)) {
        extract($array);
        ob_start();
        require_once($file);
        $page = ob_get_clean();
        return $page;
    } else {
        echo "<h1>Le fichier $file est introuvable</h1>";
        die;
    }
}

function isGranted($role)
{
    $roles_user = $_SESSION['roles'];
    $roles_user = json_decode($roles_user);
    if (in_array($role, $roles_user)) {
        return true;
    } else {
        return false;
    }
}

function crypter($password, $iteration = 125)
{
    for ($i = 1; $i <= $iteration; $i++) {
        $password = md5($password);
    }
    return $password;
}
