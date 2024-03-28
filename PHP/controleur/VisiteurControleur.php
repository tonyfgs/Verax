<?php

namespace controleur;

use controleur\UtilisateurControleur;
use Config\Validation;
use dal\Connection;
use dal\gateways\ArticleGateway;
use dal\gateways\UtilisateurGateway;
use modele\ModeleVisiteur;
use PDOException;
use Exception;


use modele\ArticleManager;
use modele\stubArticles;
use services\articlesService;

class VisiteurControleur
{
    public function __construct(){

        // echo "debut du visiteur controleur <br>";

        global $twig;

        try{
            if(!isset($_REQUEST["action"])) {
                // echo "Passage dans action nulle <br>";
                $action = NULL;
            }
            else {
                $action = Validation::nettoyerString($_REQUEST["action"]);
            }

            switch ($action){

                case NULL:
                case 'accueil':
                    $this->afficherAccueil();
                    break;

                case 'economie':
                    $this->afficherEconomie();
                    break;

                case 'afficherArticle' :
                    $this -> afficherArticle();
                    break;

                case 'culture':
                    $this->afficherCulture();
                    break;
                case 'politique':
                    $this->afficherPolitique();
                    break;
                case 'faitsDivers':
                    $this->afficherFaitsDivers();
                    break;
                case 'connexion':
                    $this->afficherConnexion();
                    break;
                case 'seConnecter':
                    $this->connect();
                    break;
                case 'Connexion':
                    $this->connection();
                    $this->afficherAccueil();
                    break;
                case 'sInscrire':
                    $this->signUp();
                    break;
                case 'Inscription':
                    $this->inscription();
                    $this->afficherAccueil();
                    break;
                case 'Api':
                    $this->api();
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
        $mdl->signUp();
    }

    function afficherArticle() {

        $mdl = new ModeleVisiteur();
        $mdl->afficherArticle();
    }

    //utiliser router afficher les pages
    function afficherAccueil(){

        // echo "Passage dans afficher accueil du front controller <br>";

        $mdl = new ModeleVisiteur();
        $mdl->afficherAccueil();

        // echo "fin de afficher accueil du visiteur controleur <br>";
    }

    public function afficherEconomie() {
        global $twig;
        // echo $twig->render('economie.html', ["userRole" => $_SESSION["role"]]);

        $mdl = new ModeleVisiteur();
        $mdl->afficherEconomie();

    }

    public function afficherCulture() {
        global $twig;

        $mdl = new ModeleVisiteur();
        $mdl->afficherCulture();
    }

    public function afficherPolitique() {
        $mdl = new ModeleVisiteur();
        $mdl->afficherPolitique();
    }

    public function afficherFaitsDivers() {
        global $twig;
        $mdl = new ModeleVisiteur();
        $mdl->afficherEnvironnement();
    }

    public function afficherConnexion() {
        global $twig;
        echo $twig->render('connexion.html', ["userRole" => $_SESSION["role"]]);
    }

    public function api() {
        $mdl = new ModeleVisiteur();
        $mdl->api();
    }


}