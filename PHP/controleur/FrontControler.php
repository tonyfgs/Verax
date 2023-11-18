<?php

namespace controleur;


use Config\Validation;
use metier\Utilisateur;
use modele\ModeleVisiteur;

class FrontControler {

    public function __construct()
    {
        global $twig;
        session_start();
        $dVueErreur = [];
        $actions = array(
            "Visiteur" => [
                "seConnecter", "sInscrire", "chercherArticle", "signalerArticle"
            ],
            "Utilisateur" => [
                "Disconnect", "GoodReview", "BadReview", "AccessForm", "SubmitForm", "SubmitForm","ReportArticle", 'AccessAccount'
            ],
            "Redacteur" => [
                "redigerArticle", "validerArticle", "publierArticle",
            ],
            "Moderateur" => [
                "supprimerArticleTemporaire", "DemanderSupprimerUtilisateur"
            ],
            "Admin" => [
                'GestionUser','BanUser','ChangeUserRole'
            ],
        );
        /*redacteur: verifierFormulaire
         *moderateur: voirSignalements
         *admin: gererModerateur
         */

        //$actions["Utilisateur"] = array_merge($actions["Utilisateur"], $actions["Visiteur"]);
        //$actions["Redacteur"] = array_merge($actions["Redacteur"], $actions["Utilisateur"]);
        //$actions["Moderateur"] = array_merge($actions["Moderateur"], $actions["Redacteur"]);
        //$actions["Admin"] = array_merge($actions["Admin"], $actions["Moderateur"]);

        $action = Validation::nettoyerString($_GET["action"] ?? "");
        if(in_array($action,$actions['Admin'])){
            echo "oui";
            if(!isset($_SESSION["role"]) || $_SESSION["role"] != 'Admin'){
                $dVueErreur[] = 'Connexion requise !';
                echo  $twig->render('error.html', ['dVueErreur' => $dVueErreur]);
            }
            else {
                new AdminControleur();
            }
        }
        else if(in_array($action,$actions['Utilisateur'])){
            echo "oui";
            if(!isset($_SESSION["role"]) || $_SESSION["role"] != 'Utilisateur'){
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