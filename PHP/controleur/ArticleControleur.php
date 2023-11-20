<?php

namespace controleur;

//je suis vraiment pas sûr pour le controleur
class ArticleControleur
{
    function __construct()
    {
        global $twig;
        try {

            switch () {
                case afficherUnArticle:
                    $this->afficherUnArticle();
                    break;
                case afficherPageArticles:
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
    }
    function afficherUnArticle(int $id){
    //gateway va recher article $id
        /*
        $statement = $pdo->prepare('SELECT * FROM article WHERE id = :id');
        $statement->execute(['id' => $id]);
        $article = $statement->fetch(PDO::FETCH_ASSOC);
        */
        global $twig;
        $article = array(
        'titreParagraphe' => 'Titre du paragraphe',
        'contenuParagraphe' => 'Contenu du paragraphe',
        'imageTitre' => 'Titre de l\'image',
        'imageChemin' => '/chemin/vers/image.jpg',
        'imageAlt' => 'Texte alternatif de l\'image',
        'videoTitre' => 'Titre de la vidéo',
        'videoLink' => 'https://www.youtube.com/watch?v=xxxxxxxxxxx'
        );

        $blocs = array(
        array('type' => 'paragraphe', 'data' => $article),
        array('type' => 'image', 'data' => $article),
        array('type' => 'video', 'data' => $article)
        );

        echo $twig->render('votre_page_twig.twig', ['TitreArticle' => 'Titre de votre article', 'blocs' => $blocs]);
    }
}