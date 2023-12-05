<?php

//namespace brouillon;

use controleur\FrontControler;

require_once  __DIR__ .'/config/config.php';
require __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/Vue');
$twig = new Twig\Environment($loader, [ 'cache' => false, 'debug' => true ]);

session_start();
if (!isset($_SESSION["role"])) {
    session_unset();
    $_SESSION["role"] = 'Visiteur';
}

global $dsn, $login, $mdp;

try {

    $gw = new \dal\gateways\ArticleGateway(new \dal\Connection($dsn, $login, $mdp));
    $mgr = new \modele\ArticleManager(new \modele\stubArticles());
    foreach ($mgr->getDerniersArticles(3) as $article){
        $serial = \modele\SerialManager::serialiserContenus($article->getContenus());
        $gw->insert($article->getId(),$article->getAuteur(), $article->getDescription(), $article->getTitre(), $serial, $article->getTemps(), $article->getImagePrincipale());
    }

    //$cont = new FrontControler();

} catch (Exception $e) {
    echo $e -> getMessage();
}

//require("./brouillon/brouillonArticle.php");
