<?php

namespace modele;

use dal\Connection;
use dal\gateways\ArticleGateway;
use dal\gateways\FormulaireGateway;
use dal\gateways\SignalementGateway;
use dal\gateways\UtilisateurGateway;
use metier\Formulaire;
use metier\Utilisateur;

class ModeleAdmin
{
    public function isAdmin(){
        return isset($_SESSION["role"]) && $_SESSION["role"] == 'Admin';
    }

    public function disconnect(){
        global $twig;
        session_unset();
        $_SESSION["role"] = 'Visiteur';
        $mdl = new ModeleVisiteur();
        $mdl->afficherAccueil();
    }

    public function banUser(){
        global $dsn, $login, $mdp, $twig;
        $id = $_POST['id'];
        $motif = $_POST['motif'];
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        $verif = $gw->banAnUser($id, $_SESSION["pseudo"], $motif);
        if($verif){
            echo "Bannissement réussi";
        }
        else{
            echo "Bannissement échoué";
        }
        $this->gestionUser();
    }

    public function gestionUser(){
        global $twig, $dsn, $login, $mdp;
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        $tab = $gw->findAllUser();
        $tab2 = array();
        foreach ($tab as $t){
            if ($t->getRole() != 'A'){
                $tab2[] = $t;
            }
        }
        echo $twig->render('adminUserList.html', ['utilisateurs' => $tab2,  "userRole" => $_SESSION["role"]]);
    }

    public function unBanUser(){
        global $twig, $dsn, $login, $mdp;
        $id = $_POST['id'];
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        $verif = $gw->unBanAnUser($id);
        if($verif){
            echo "Débannissement réussi";
        }
        else{
            echo "Débannissement échoué";
        }
        $this->gestionUser();
    }

    public function changeUserRole(){
        global $twig, $dsn, $login, $mdp;
        global $dsn, $login, $mdp, $twig;
        $id = $_POST['id'];
        $role = $_POST['role'];
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        $users = $gw->findUserByPseudo($id);
        $user = $users[0];
        try {
            $verif = $gw->update($user->getpseudo(), $user->getPrenom(), $user->getNom(), $user->getMdp(), $user->getMail(), $role[0]);
        }
        catch (Exception $ex){
            $dataVueErreur[] = "Erreur Inscription !";
            echo $twig->render("error.html",['dVueErreur' => $dataVueErreur]);
        }
        if($verif){
            echo "Changement de rôle réussi";
        }
        else{
            echo "Changement de rôle échoué";
        }
        $this->gestionUser();
    }

    public function administrer(){
        global $twig;
        echo $twig->render("VueAdminLayout.html", ["userRole" => $_SESSION["role"]]);
    }

    public function accessForm(){
        global $twig, $dsn, $mdp, $login;
        $gw = new UtilisateurGateway(new Connection($dsn, $login,$mdp));
        if ($gw->isBan($_SESSION["pseudo"])){
            echo  $twig->render('error.html', ['dVueErreur' => array('Vous n êtes plus autorisée à faire cette action pour le moment !')]);
        }
        else {
            echo $twig->render('contact.html', ['userRole' => $_SESSION["role"]]);
        }
    }

    public function accessAccount(){
        global $dsn, $login, $mdp, $twig;
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        $User = $gw->findUserByPseudo($_SESSION['pseudo']);
        echo $twig->render('CompteUtilisateur.html', ['utilisateur' => $User[0], 'userRole' => $_SESSION["role"] ]);
    }

    public function  submitFormBug(){
        global $dsn, $login, $mdp, $twig;
        $gw = new FormulaireGateway(new Connection($dsn, $login, $mdp));
        $result =  mail("Tony.FAGES@etu.uca.fr","Bug Report",$_POST["champ3-1"]);
        echo $twig->render('contact.html', ['userRole' => $_SESSION["role"]]);

    }

    public function SubmitFormFakeNews() {
        global $dsn, $login, $mdp, $twig;
        $gw = new FormulaireGateway(new Connection($dsn, $login, $mdp));
        echo "Je suis la ";
        // Vérifier si les clés existent dans $_POST
        $champ1_1 = isset($_POST['champ1-1']) ? $_POST['champ1-1'] : null;
        $champ1_2 = isset($_POST['champ1-2']) ? $_POST['champ1-2'] : null;
        $champ1_3 = isset($_POST['champ1-3']) ? $_POST['champ1-3'] : null;
        $result = true;
        $gw->insertFormFakeNews($champ1_1, $champ1_2, $champ1_3,$_SESSION["pseudo"]);
        if ($result){
            echo $_SESSION["pseudo"];
            echo " envoie du formulaire confirmer merci pour votre contribution";
        }
        else {
            echo "Erreur envoie du formulaire";

        }
        $mdl = new ModeleVisiteur();
        $mdl->afficherAccueil();

    }


    public function   SubmitFormArticle(){
        global $dsn, $login, $mdp, $twig;
        $gw = new FormulaireGateway(new Connection($dsn, $login, $mdp));
        echo "1";
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            echo "2";
            $result = $gw->insertFormMessage($_POST['pseudo'],$_POST['email'],$_POST['name'],$_POST['surname']);
            echo $twig->render('contact.html', ['userRole' => $_SESSION["role"]]);
        }
    }

    public function getAllForm(){
        global $dsn, $login, $mdp, $twig;
        $gw = new FormulaireGateway(new Connection($dsn, $login, $mdp));
        $tab = $gw->getAllForm();
        echo $twig->render('adminFormList.html', ['forms' => $tab,  "userRole" => $_SESSION["role"]]);
    }

    public function listReport(){
        global $dsn, $login, $mdp, $twig;
        $gw = new SignalementGateway(new Connection($dsn, $login, $mdp));
        $tab = $gw->getAllReporting();
        usort($tab, function($a, $b) {  
            if ($a['idArticle'] == $b['idArticle']) {
                return $b['dateSignalement'] <=> $a['dateSignalement'];
            }
            return $a['idArticle'] <=> $b['idArticle'];
        });
        echo $twig->render('adminReport.html', array('reports' => $tab,  "userRole" => $_SESSION["role"]));
    }

    public function reportArticle(){
        global $dsn, $login, $mdp, $twig;
        $gw = new SignalementGateway(new Connection($dsn, $login, $mdp));
        $result = $gw->insertReporting($_POST['motif'],$_POST['articleId']);
        $manager = new ArticleManager(new ArticleGateway(new Connection($dsn, $login, $mdp)));
        $tabArticles = array();
        $tabArticles = $manager -> getDerniersArticles(3);
        echo $twig->render('accueil.html', ["userRole" => $_SESSION["role"], 'articles' => $tabArticles]);
    }

}