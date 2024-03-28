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
use modele\stubArticles;

//use services\articlesService;

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


    function afficherEconomie() {

        global $twig;
        $serviceApi = new articlesService('http://181.214.189.133:9092');
        $manager = new ArticleManager($serviceApi);
        

        $tabArticles = array();

        $tabArticles = $manager -> getDerniersArticles(10);

        $tabArticlesfinaux = [];

        foreach ($tabArticles as $article) {

            if ($article -> getCategorie() === "economie") {

                $tabArticlesfinaux[] = $article;
            }
        }
        echo $twig->render('economie.html', ["userRole" => $_SESSION["role"], 'articles' => $tabArticlesfinaux]);

    }

    function afficherEnvironnement() {

        global $twig;
        $serviceApi = new articlesService('http://181.214.189.133:9092');
        $manager = new ArticleManager($serviceApi);
        

        $tabArticles = array();

        $tabArticles = $manager -> getDerniersArticles(10);

        $tabArticlesfinaux = [];

        foreach ($tabArticles as $article) {

            if ($article -> getCategorie() === "environnement") {

                $tabArticlesfinaux[] = $article;
            }
        }
        echo $twig->render('economie.html', ["userRole" => $_SESSION["role"], 'articles' => $tabArticlesfinaux]);

    }

    function afficherPolitique() {

        global $twig;
        $serviceApi = new articlesService('http://181.214.189.133:9092');
        $manager = new ArticleManager($serviceApi);
        

        $tabArticles = array();

        $tabArticles = $manager -> getDerniersArticles(10);

        $tabArticlesfinaux = [];

        foreach ($tabArticles as $article) {

            if ($article -> getCategorie() === "politique") {

                $tabArticlesfinaux[] = $article;
            }
        }
        echo $twig->render('economie.html', ["userRole" => $_SESSION["role"], 'articles' => $tabArticlesfinaux]);

    }


    function afficherCulture() {

        global $twig;
        $serviceApi = new articlesService('http://181.214.189.133:9092');
        $manager = new ArticleManager($serviceApi);
        

        $tabArticles = array();

        $tabArticles = $manager -> getDerniersArticles(10);

        $tabArticlesfinaux = [];

        foreach ($tabArticles as $article) {

            if ($article -> getCategorie() === "culture") {

                $tabArticlesfinaux[] = $article;
            }
        }
        echo $twig->render('economie.html', ["userRole" => $_SESSION["role"], 'articles' => $tabArticlesfinaux]);

    }



    function afficherArticle() {
        global $twig, $dsn, $login, $mdp;

        // marche plus pour l'instant : 
        // $manager = new ArticleManager(new ArticleGateway(new Connection($dsn, $login, $mdp)));

        $serviceApi = new articlesService('http://181.214.189.133:9092');
        $manager = new ArticleManager($serviceApi);


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
       
        // Obsolète tant que bdd pas de retour
        //$manager = new ArticleManager(new ArticleGateway(new Connection($dsn, $login, $mdp)));

        // Version avec le stub :
        // $manager = new ArticleManager(new stubArticles());


        // Version avec l'api : http://181.214.189.133:9092
        $serviceApi = new articlesService('http://181.214.189.133:9092');
        $manager = new ArticleManager($serviceApi);
        

        $tabArticles = array();

        $tabArticles = $manager -> getDerniersArticles(10);

        echo $twig->render('accueil.html', ["userRole" => $_SESSION["role"], 'articles' => $tabArticles]);

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
