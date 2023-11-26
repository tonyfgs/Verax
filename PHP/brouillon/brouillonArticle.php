<?php


namespace brouillon;

use dal\gateways\ArticleGateway;
use modele\ArticleManager;
use dal\Connection;
use pdo;
use PDOException;

    $articleManager = new ArticleManager();
    $articleCourant = $articleManager -> getArticle(6);

    


    //echo $ret;

    echo "Coucouuuuuu !";

    try {

        $gw = new ArticleGateway(new Connection($dsn, $login, $mdp));

        $ret = $gw -> insert($articleCourant -> getId(), 
                            $articleCourant -> getTitre(),
                            "ceci est le contenu et tout et tout...",
                            $articleCourant -> getTemps(),
                            $articleCourant -> getDescription());

        $recup = $gw -> recupAllArticles();

    } catch (PDOException $e) {
        echo "Erreur PDO : ".$e -> getMessage();
    }

    if (isset($ret)) {
        echo "Valeur de retour ... : " . $ret;
    }

    if (!isset($recup)) {
        $recup = $articleCourant;
    }
    

    echo $twig->render('Article.html', ['article' => $recup]);
?>