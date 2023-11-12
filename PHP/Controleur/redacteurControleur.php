<?php

class redacteurControleur
{
    function __construct()
    {
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
                    require("vues/connexion.php");
            }
        } catch (Exception $e) {
            require("vues/error.php");
        }
    }
}