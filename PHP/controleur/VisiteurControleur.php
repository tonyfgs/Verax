<?php

namespace controleur;

use controleur\UtilisateurControleur;
use Config\Validation;
use dal\gateways\ArticleGateway;
use dal\gateways\UtilisateurGateway;
use modele\ModeleVisiteur;
use PDOException;
use Exception;
use modele\ArticleManager;

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
        global $twig;
        $manager = new ArticleManager();
        $articleTemp = $manager -> getArticle(7);
        echo $twig -> render('article.html', ['Article.html' => $articleTemp]);
    }

    //utiliser router afficher les pages
    function afficherAccueil(){
        global $twig;
        $tabArticles = array();
        $manager = new ArticleManager();
        $tabArticles = $manager -> getDerniersArticles(2);
        echo $twig->render('accueil.html', ["userRole" => $_SESSION["role"], 'articles' => $tabArticles]);
    }

    public function afficherEconomie() {
        global $twig;
        echo $_SESSION["role"];
        echo $twig->render('economie.html', ["userRole" => $_SESSION["role"]]);
    }

    public function afficherCulture() {
        global $twig;

        echo $twig->render('culture.html', ["userRole" => $_SESSION["role"]]);
    }

    public function afficherPolitique() {
        global $twig;
        echo $twig->render('politique.html', ["userRole" => $_SESSION["role"]]);
    }

    public function afficherFaitsDivers() {
        global $twig;
        echo $twig->render('faitsDivers.html', ["userRole" => $_SESSION["role"]]);
    }

    public function afficherConnexion() {
        global $twig;
        echo $twig->render('connexion.html', ["userRole" => $_SESSION["role"]]);
    }


}