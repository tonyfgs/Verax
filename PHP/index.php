<?php

use controleur\FrontControler;

require_once __DIR__ . '/config/config.php';
require __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/Vue');
$twig = new \Twig\Environment($loader, ['cache' => false]);

//var_dump($loader->getPaths());
try {
    $cont = new FrontControler();
} catch (\Twig\Error\LoaderError $e) {
    echo 'Erreur de chargement du modèle : ' . $e->getMessage();
} catch (\Twig\Error\RuntimeError $e) {
    echo 'Erreur d\'exécution du modèle : ' . $e->getMessage();
} catch (\Twig\Error\SyntaxError $e) {
    echo 'Erreur de syntaxe du modèle : ' . $e->getMessage();
}