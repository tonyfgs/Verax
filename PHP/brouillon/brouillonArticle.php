<?php


namespace brouillon;

use dal\gateways\ArticleGateway;
use modele\ArticleManager;
use dal\Connection;
use metier\Article;
use modele\SerialManager;
use modele\stubArticles;
use pdo;
use PDOException;

    $articleManager = new ArticleManager(new stubArticles());
    $articleCourant = $articleManager -> getArticle(6);

    $stockageContenusSerialises = SerialManager::serialiserContenus($articleCourant -> getContenus());

    //echo "Contenus serialisés : " . $stockageContenusSerialises;

    $articleFinal = new Article(1, "Thinkerview", "Thinkerview est une chaîne youtube d'interview-débat, 
                                    lancée en 2013 qui produit de longs entretiens entre un animateur en voix off 
                                    et ses invités. Les émissions sont toujours
                                    diffusées en direct, puis republiées sans montage. ", 3, date("d-m-Y"), "Siwa", 
                                    "assets/img/mainThinkerview.webp");

    // On s'assure que l'article courant est bien vide... : 
    unset($articleCourant);

    $stockageContenusDeserialises = SerialManager::deserialiserContenus($stockageContenusSerialises);
    $articleFinal -> remplirArticle($stockageContenusDeserialises);

    echo $twig->render('Article.html', ['article' => $articleFinal]);

    //echo $ret;

    // echo "Coucouuuuuu !";

    // try {

    //     $gw = new ArticleGateway(new Connection($dsn, $login, $mdp));

    //     $ret = $gw -> insert($articleCourant -> getId(), 
    //                         $articleCourant -> getTitre(),
    //                         "ceci est le contenu et tout et tout...",
    //                         $articleCourant -> getTemps(),
    //                         $articleCourant -> getDescription());

    //     $recup = $gw -> recupAllArticles();

    // } catch (PDOException $e) {
    //     echo "Erreur PDO : ".$e -> getMessage();
    // }

    // if (isset($ret)) {
    //     echo "Valeur de retour ... : " . $ret;
    // }

    // if (!isset($recup)) {
    //     $recup = $articleCourant;
    // }
    
    //echo "Titre de l'article : " . $articleCourant -> getTitre();
    //echo $twig->render('Article.html', ['article' => $articleCourant]);
?>