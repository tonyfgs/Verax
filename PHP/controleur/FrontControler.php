<?php

namespace controleur;



use Config\Validation;
use modele\ModeleVisiteur;

class FrontControler {

    public function __construct()
    {
        $actions = array(
            "Visiteur" => [
                "seConnecter", "sInscrire", "accueil", "chercherArticle", "signalerArticle"
            ],
            "Utilisateur" => [
                "deconnexion", "noter", "envoyerFormulaire", "modifierProfil"
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

        $actions["Utilisateur"] = array_merge($actions["Utilisateur"], $actions["Visiteur"]);
        $actions["Redacteur"] = array_merge($actions["Redacteur"], $actions["Utilisateur"]);
        $actions["Moderateur"] = array_merge($actions["Moderateur"], $actions["Redacteur"]);
        $actions["Admin"] = array_merge($actions["Admin"], $actions["Moderateur"]);

        session_start();
        $modele = new ModeleVisiteur();
        $action = Validation::nettoyerString($_GET["action"] ?? "");
        $personne=$modele->estConnecte();

        if (!$this->checkAccess($actions, $action, $personne)) {
            echo "<br>ERREUR : Accès refusé, vous ne pouvez pas faire cette action";
        }
    }

    private function checkAccess($actions, $action, $personne) {
        if ($personne == null) {
            require("Vue/connexion.php");
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