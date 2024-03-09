<?php

namespace modele;

use controleur\VisiteurControleur;
use dal;
use dal\gateways\UtilisateurGateway;
use Exception;
use dal\Connection;
use PDOException;
use dal\gateways\ArticleGateway;
use modele\ArticleManager;

class ModeleVisiteur
{

    public function estConnecte() : bool
    {
        if(isset($_SESSION['pseudo']) && !empty($_SESSION['pseudo']))
        {
            return true;
        }
        return false;
    }

    public function signUp(){
        global $dsn, $login, $mdp, $twig;
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $tab = $gw->findUserByPseudo($_POST['pseudo']);
            if (!empty($tab)) {
                throw new PDOException();
            }
            $verif = $gw->insert($_POST['pseudo'],$_POST['nom'],$_POST['prenom'],$_POST['mdp'],$_POST['mail'],'U');
            echo $twig->render('connexion.html');
        }
        else{
            $dataVueErreur[] = "Erreur Inscription !";
            echo $twig->render("error.html",['dVueErreur' => $dataVueErreur]);
        }
    }

    public function connect() {
        global $dsn, $login, $mdp, $twig;
        try{
            $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
            $tab = $gw->findUserByPseudo($_POST['pseudo']);
            if (empty($tab) ){
                $dataVueErreur[] = "Pseudo et/ou mot de passe incorrect(s)";
                echo $twig->render("error.html",['dVueErreur' => $dataVueErreur]);
            }
            else {
                $user = $tab[0];

                if (password_verify($_POST['mdp'], $user->getMdp())) {
                    $_SESSION['pseudo'] = $_POST['pseudo'];
                    $_SESSION['nom'] = $user->getNom();
                    $_SESSION['prenom'] = $user->getPrenom();
                    $_SESSION['mail'] = $user->getMail();
                    switch ($user->getRole()) {
                        case 'U':
                            $_SESSION['role'] = 'Utilisateur';
                            break;
                        case 'A':
                            $_SESSION['role'] = 'Admin';
                            break;
                        default :
                            $_SESSION['role'] = 'Visiteur';
                            break;
                    }
                } else {
                    $dataVueErreur[] = "Pseudo et/ou mot de passe incorrect(s)";
                    echo $twig->render("error.html", ['dVueErreur' => $dataVueErreur]);
                }
            }
        }
        catch (Exception $e) {
            $dataVueErreur[] = "Pseudo et/ou mot de passe incorrect(s)";
            echo $twig->render("error.html",['dVueErreur' => $dataVueErreur]);
        }
        catch (ExceptionPDO $e2) {
            $dataVueErreur[] = "Pseudo et/ou mot de passe incorrect(s) en BDD";
            echo $twig->render("error.html",['dVueErreur' => $dataVueErreur]);
        }
    }

    function afficherArticle() {
        global $twig, $dsn, $login, $mdp;

        // marche plus pour l'instant : 
        // $manager = new ArticleManager(new ArticleGateway(new Connection($dsn, $login, $mdp)));

        $manager = new ArticleManager(new stubArticles());

        if (!isset($_POST['articleId']) || empty($_POST['articleId'])) {
            $dataVueErreur[] = "Une erreur est survenue : L'article est introuvable.";
            echo $twig->render("error.html",['dVueError' => $dataVueErreur]);
        } else {
            $idArticle = htmlspecialchars($_POST['articleId']);
        }

        $articleTemp = $manager -> getArticle($idArticle);
        echo $twig -> render('Article.html', ['article' => $articleTemp, 'userRole' => $_SESSION['role']]);
    }

    //utiliser router afficher les pages
    function afficherAccueil(){

        // echo "Passage dans afficher accueil du Modele Visiteur <br>";

        global $twig, $dsn, $login, $mdp;
        // echo "initialisation des variables ok <br>";
        // echo "encore un msg <br>";
        
        // Obsolète tant que bdd pas de retour
        //$manager = new ArticleManager(new ArticleGateway(new Connection($dsn, $login, $mdp)));

        // Version avec le stub :
        $manager = new ArticleManager(new stubArticles());
        
        // echo "instanciation du manager ok <br>";

        $tabArticles = array();

        $tabArticles = $manager -> getDerniersArticles(3);
        echo $twig->render('accueil.html', ["userRole" => $_SESSION["role"], 'articles' => $tabArticles]);
    
        // echo "fin de afficher accueil du Modele Visiteur  <br>";
    }

    public function api() {
        global $dsn, $login, $mdp, $twig;
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        $users = $gw->findAllUser();
        $json = json_encode($users,128);
        $ip_address = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
        $target_url = "http://" . $ip_address . "/users_json";
        $options = [
            'http' => [
                'header'  => "Content-type: application/json",
                'method'  => 'POST',
                'content' => $json,
            ],
        ];
        $context  = stream_context_create($options);
        // Envoi de la requête POST
        $response = file_get_contents($target_url, false, $context);
        // Vérification de la réponse
        if ($response === FALSE) {
        // Gestion des erreurs
            echo "Erreur lors de l'envoi de la requête.";
        } else {
        // Traitement de la réponse
            echo "Réponse reçue : " . $response;
        }
    }

}