<?php

namespace controleur;

use controleur\UtilisateurControleur, config\Validation;

use dal\gateways\UtilisateurGateway;
use Modele\ModeleVisiteur;
use PDOException;


class VisiteurControleur
{
    public function __construct(){
        global $twig;

        try{
            if(!isset($_REQUEST["action"]))
            {
                $action = NULL;
            }
            else
            {
                $action = Validation::nettoyerString($_REQUEST["action"]);
            }
            switch ($action){
                case NULL:

                case 'seConnecter':
                    $this->connect();
                    break;
                case 'sInscrire':
                    $this->signUp();
                    break;

                default:
                    $dataVueErreur[] = "Erreur d'appel PHP";
                    echo $twig->render("../Vue/error.html",['dVueError' => $dataVueErreur]);

            }
        }
        catch (PDOException $e){
            $dataVueErreur[] = "Erreur de BDD !";
            require("../Vue/error.php");
        }
        catch (Exception $e2){
            $dataVueErreur[] = "Erreur !";
            require("../Vue/error.php");
        }
    }

    function signUp() {
        $md = new ModeleVisiteur();
        $md->signUp();
    }

    function connect() {
        $md = new ModeleVisiteur();
        $md->connect();
        new UtilisateurControleur();
    }

}