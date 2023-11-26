<?php

namespace controleur;

class redacteurControleur
{
    function __construct()
    {
        global $twig;
        try {
            if(!isset($_REQUEST["action"]))
            {
                $action = NULL;
            }
            else
            {
                $action = Validation::nettoyerString($_REQUEST["action"]);
            }
            switch ($action) {
                case redigerArticle:
                    $this->redigerArticle();
                    break;
                case validerArticle:
                    $this->validerArticle();
                    break;
                case publierArticle:
                    $this->publierArticle();
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