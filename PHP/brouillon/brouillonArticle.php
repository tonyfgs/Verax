<?php


namespace brouillon;
use modele\ArticleManager;

    $articleManager = new ArticleManager();
    $articleCourant = $articleManager -> getArticle(6);


    // foreach ($articleCourant -> getContenus() as $contenu) {

    //     switch ($contenu -> getTypeContenu()) {

    //         case "paragraphe" : 
    //             include("blocParagrapheBrouillon.php");
    //             break;

    //         default : 
    //     }
    // }

    echo $twig->render('Article.html', [$articleCourant]);
?>