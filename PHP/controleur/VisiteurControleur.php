<?php

namespace Controleur;

use Modele\ModeleUtilisateur;
use Modele\ModeleVisiteur;
use MongoDB\Driver\Exception\Exception;

class VisiteurControleur
{
    public function __construct(){
        global $twig;
        session_start();

        try{
            if(!isset($_REQUEST["action"]))
            {
                $action = NULL;
            }
            else
            {
                $action = \Validation::nettoyerString($_REQUEST["action"]);
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


    function redirect_by_path($path)
    {
        $redirect = substr(strtr(realpath($path), '\\', '/'), strlen($_SERVER['DOCUMENT_ROOT']));
        header("location: $redirect");
        exit;
    }

    function signUp() {
        $md = new ModeleVisiteur;
        $md->signUp();
        $redirect = redirect_by_path(__DIR__.'/../Vue/connexion.php');
        header("Location: $redirect");
    }

    function connect() {
        $md = new ModeleVisiteur;
        $md->connect();
        new UtilisateurControleur();
    }

}