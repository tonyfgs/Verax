<?php
//namespace brouillon;

use controleur\FrontControler;

require_once  __DIR__ .'/config/config.php';
require __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/Vue');
$twig = new Twig\Environment($loader, [ 'cache' => false, 'debug' => true ]);


session_start();

// echo "passage apres le session start... <br>";

if (!isset($_SESSION["role"])) {
    session_unset();
    $_SESSION["role"] = 'Visiteur';
}

$cont = new FrontControler();

//require("./brouillon/brouillonArticle.php");

echo "Fin de l'index...";
