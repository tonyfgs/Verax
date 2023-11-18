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
                "modifierRole"
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
        if(in_array($action,$actions['Utilisateur'])){
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

    private function checkAccess($actions, $action, $personne) {
        if ($personne == null) {
            require("Vue/connexion.html");
            echo "<br>ERREUR : Vous n'êtes pas connecté, veuillez vous connecter pour accéder à cette fonctionnalité";
            return false;
        } else {
            $role = $this->getUserRole($personne);
            if (in_array($action, $actions[$role])) {
                $this->routeToController($role);
                return true;
            }
        }
        return false;
    }

    private function getUserRole($personne) {
        return $personne->role;
    }

    private function routeToController($role) {
        switch ($role) {
            case 'Utilisateur':
                new UtilisateurControleur();
                break;
            /**case 'Redacteur':
                new ControleurRedacteur();
                break;
            case 'Moderateur':
                new ControleurModerateur();
                break;
            case 'Admin':
                new ControleurAdmin();
                break;
            */
            default:
                new VisiteurControleur();
        }
    }


}

?>