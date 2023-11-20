<?php

namespace modele;

use dal;
use dal\gateways\UtilisateurGateway;
use Exception;
use dal\Connection;
use PDOException;

class ModeleVisiteur
{

    public function estConnecte() : bool
    {
        if(isset($_SESSION["pseudo"]) && !empty($_SESSION["pseudo"]))
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
            $verif = false;
            var_dump($verif);
            echo $twig->render('connexion.html');
        }
    }

    public function connect() {
        global $dsn, $login, $mdp, $twig;
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        $tab = $gw->findUserByPseudo($_POST['pseudo']);
        $user = $tab[0];
        if (password_verify($_POST['mdp'],$user->getMdp())) {
            $_SESSION['pseudo'] = $_POST['pseudo'];
            $_SESSION['mdp'] = $user->getMdp();
            $_SESSION['nom'] = $user->getNom();
            $_SESSION['prenom'] = $user->getPrenom();
            $_SESSION['mail'] = $user->getMail();
            $_SESSION['role'] = $user->getRole();   
        }
        else {
            throw new Exception("Pseudo et/ou mot de passe incorrect(s)");
        }
        echo $twig->render('accueil.html', ["userRole" => $_SESSION['role']]);

    }

    public function accessForm(){
        global $twig;
        echo $twig->render('contact.html', []);
    }

    public function accessAccount(){
        global $twig;
        echo $twig->render('', []);
    }
}