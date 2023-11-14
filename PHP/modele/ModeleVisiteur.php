<?php

namespace Modele;

use Connection;
use Exception;
use PDO;
use PDOException;
use UtilisateurGateway;

class ModeleVisiteur
{

    public function signUp(){
        global $dsn, $login, $mdp;
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $tab = $gw->findUserByPseudo($_POST['pseudo']);
            if (!empty($tab)) {
                throw new PDOException();
            }
            $verif = $gw->insert($_POST['pseudo'],$_POST['nom'],$_POST['prenom'],$_POST['mdp'],$_POST['mail'],'U');
            if (!$verif) {
                throw new PDOException();
            }

        }
    }

    public function connect() {
        global $dsn, $login, $mdp;
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        $tab = $gw->findUserByPseudo($_POST['pseudo']);
        $user = $tab[0];
        if (password_verify($_POST['mdp'],$user->getMdp())) {
            session_start();
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