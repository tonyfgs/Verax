<?php

namespace modele;

use dal\Connection;
use dal\gateways\FormulaireGateway;
use dal\gateways\UtilisateurGateway;
use metier\Utilisateur;

class ModeleAdmin
{
    function isAdmin(){
        return isset($_SESSION["role"]) || $_SESSION["role"] == 'Admin';
    }

    public function disconnect(){
        global $twig;
        session_unset();
        $_SESSION["role"] = 'Visiteur';
        echo $twig->render('accueil.html', ["userRole" => $_SESSION["role"]]);
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

    public function submitForm(){
        global $dsn, $login, $mdp, $twig;
        $gw = new FormulaireGateway(new Connection($dsn, $login, $mdp));
        echo "1";
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            echo "2";
            $result = $gw->insertFormMessage($_POST['pseudo'],$_POST['email'],$_POST['name'],$_POST['surname']);
            echo "3";
        }
    }

}