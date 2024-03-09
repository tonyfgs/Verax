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

/*
global $dsn, $login, $mdp;
$gw = new \dal\gateways\ArticleGateway(new \dal\Connection($dsn, $login, $mdp));
$mgr = new \modele\ArticleManager(new \modele\stubArticles());
foreach ($mgr->getDerniersArticles(3) as $article){
    $serial = \modele\SerialManager::serialiserContenus($article->getContenus());
    $gw->insert($article->getId(),$article->getAuteur(), $article->getDescription(), $article->getTitre(), $serial, $article->getTemps(), $article->getImagePrincipale());
}
*/

$cont = new FrontControler();

//require("./brouillon/brouillonArticle.php");

echo "Fin de l'index...";
