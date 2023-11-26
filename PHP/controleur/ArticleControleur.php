<?php

namespace controleur;
use dal\gateways\ArticleGateway; //pour $con
use dal\Connection;

//A suppr, transéré dans VisiteurControleur


class ArticleControleur
{
    private $articleGateway;

    function __construct($action, $id, $page)
    {
        global $twig;
        $this->articleGateway = new ArticleGateway();

        try {
            switch ($action) {
                case 'afficherUnArticle':
                    $this->afficherUnArticle( $id, $page);
                    break;
                case 'afficherPageArticles':
                    $this->afficherPageArticles();
                    break;
                default:
                    $VueErreur[] ="Erreur d'appel php";
                    echo $twig->render("Vue/connexion.php");
            }
        } catch (Exception $e) {
            echo $twig->render("Vue/error.php");
        }
    }

    function afficherUnArticle(int $id, string $page) //page est la page d'affichage de l'article
    {
        global $twig;
        try {
            $article = $this->articleGateway->getArticleById($id);

            if ($article) {
                $blocs = array(
                    array('type' => 'paragraphe', 'data' => $article),
                    array('type' => 'image', 'data' => $article),
                    array('type' => 'video', 'data' => $article)
                );

                echo $twig->render($page, ['TitreArticle' => $article['titreArticle'], 'blocs' => $blocs]);
            } else {
                echo $twig->render("Vue/error.php"); //article non trouvé
            }
        } catch (Exception $e) {
            echo $twig->render("Vue/error.php");
        }
    }
}