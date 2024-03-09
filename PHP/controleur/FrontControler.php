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
        // echo "debut du front controller... <br>";

        global $twig;
        $dVueErreur = [];

        $actions = array(
            "Visiteur" => [
                "seConnecter", "sInscrire", "Connexion", "Inscription", "accueil", "economie", "api"
            ],
            "Utilisateur" => [
                "Disconnect", "GoodReview", "BadReview", "AccessForm", "SubmitFormBug", "SubmitFormFakeNews","SubmitFormArticle","ReportArticle", 'AccessAccount', 'DeleteProfil'
            ],
            "Redacteur" => [
                "redigerArticle", "validerArticle", "publierArticle","SujetSoumis"
            ],
            "Moderateur" => [
                "supprimerArticleTemporaire", "DemanderSupprimerUtilisateur"
            ],
            "Admin" => [
                'GestionUser',"SujetSoumis",'BanUser','ChangeUserRole','UnbanUser', 'Administrer', "ListReport"
            ],
        );

        $action = Validation::nettoyerString($_GET["action"] ?? "");

        if(in_array($action,$actions['Admin'])){

            $mdl = new ModeleAdmin();

            if(!$mdl->isAdmin()){

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