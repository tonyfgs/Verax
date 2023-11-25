<?php


namespace brouillon;

use dal\gateways\ArticleGateway;
use modele\ArticleManager;
use dal\Connection;

    $articleManager = new ArticleManager();
    $articleCourant = $articleManager -> getArticle(6);

    $gw = new ArticleGateway(new Connection($dsn, $login, $mdp));

    $ret = $gw -> insert($articleCourant -> getId(), 
                         $articleCourant -> getTitre(),
                         "ceci est le contenu et tout et tout...",
                        $articleCourant -> getTemps(),
                         $articleCourant -> getDescription());


    echo $ret;
    

    //echo $twig->render('Article.html', ['article' => $articleCourant]);
?>