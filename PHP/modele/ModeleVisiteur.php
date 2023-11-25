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

}