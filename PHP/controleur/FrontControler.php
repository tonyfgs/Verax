<?php

namespace controleur;


use Config\Validation;
use metier\Utilisateur;
use modele\ModeleAdmin;
use modele\ModeleUtilisateur;
use modele\ModeleVisiteur;

class FrontControler {

    public function __construct()
    {
        global $twig;
        $dVueErreur = [];
        $actions = array(
            "Visiteur" => [
                "seConnecter", "sInscrire", "Connexion", "Inscription", "accueil"
            ],
            "Utilisateur" => [
                "Disconnect", "GoodReview", "BadReview", "AccessForm", "SubmitForm", "SubmitForm","ReportArticle", 'AccessAccount', "accueil"
            ],
            "Redacteur" => [
                "redigerArticle", "validerArticle", "publierArticle",
            ],
            "Moderateur" => [
                "supprimerArticleTemporaire", "DemanderSupprimerUtilisateur"
            ],
            "Admin" => [
                'GestionUser','BanUser','ChangeUserRole', "accueil", "AccessForm"
            ],
        );
        $action = Validation::nettoyerString($_GET["action"] ?? "");
        if(in_array($action,$actions['Admin'])){
            $mdl = new ModeleAdmin();

            if($mdl->isAdmin()){
                $dVueErreur[] = 'Connexion requise !';
                echo  $twig->render('error.html', ['dVueErreur' => $dVueErreur]);
            }
            else {
                new AdminControleur();
            }
        }
        else if(in_array($action,$actions['Utilisateur'])){
            $mdl = new ModeleUtilisateur();
            if($mdl->isUser()){
                $dVueErreur[] = 'Connexion requise !';
                echo  $twig->render('error.html', ['dVueErreur' => $dVueErreur]);
            }
            else {
                new UtilisateurControleur();
            }
        }
        else {
            new VisiteurControleur();
        }
    }

}

?>