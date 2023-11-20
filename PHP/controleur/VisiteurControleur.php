<?php

namespace controleur;

use controleur\UtilisateurControleur;
use Config\Validation;
use dal\gateways\UtilisateurGateway;
use modele\ModeleVisiteur;
use PDOException;


class VisiteurControleur
{
    public function __construct(){
        global $twig;

        try{
            if(!isset($_REQUEST["action"])) {
                $action = NULL;
            }
            else {
                $action = Validation::nettoyerString($_REQUEST["action"]);
            }
            switch ($action){
                case NULL:
                case 'accueil':
                    $this->accueil();
                    break;
                case 'seConnecter':
                    $this->connect();
                    break;
                case 'Connexion':
                    $this->connection();
                    break;
                case 'sInscrire':
                    $this->signUp();
                    break;
                case 'Inscription':
                    $this->inscription();
                    break;
                default:
                    $dataVueErreur[] = "Action Non-Autorisé si pas connecté";
                    echo $twig->render("error.html",['dVueError' => $dataVueErreur]);

            }
        }
        catch (PDOException $e){
            $dataVueErreur[] = "Erreur de BDD !";
            echo $twig->render("error.html",['dVueErreur' => $dataVueErreur]);
        }
        catch (Exception $e2){
            $dataVueErreur[] = "Erreur !";
            echo $twig->render("error.html",['dVueErreur' => $dataVueErreur]);
        }
    }

    function signUp() {
        global $twig;
        echo $twig->render('inscription.html');
        $mdl = new ModeleVisiteur();
        $mdl->signUp();
    }

    function connect() {
        global $twig;
        echo $twig->render('connexion.html');
    }

    function connection(){
        $mdl = new ModeleVisiteur();
        $mdl->connect();
    }

    function inscription(){
        $mdl = new ModeleVisiteur();
        $mdl->connect();
    }

    function accueil(){
        global $twig;
        echo $twig->render('accueil.html', []);
    }

}