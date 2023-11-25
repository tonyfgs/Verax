<?php

namespace controleur;

use dal\Connection;
use dal\gateways\ArticleGateway;
use dal\gateways\UtilisateurGateway;
use Config\Validation;
use modele\ModeleAdmin;
use modele\ModeleUtilisateur;

class AdminControleur
{
    public function __construct()
    {
        global $twig;

        try {
            if (empty($_REQUEST["action"])) {
                $action = NULL;
            } else {
                $action = Validation::nettoyerString($_REQUEST["action"]);
            }
            switch ($action) {
                case 'GestionUser':
                    $this->gestionUser();
                    break;
                case 'BanUser':
                    $this->banUser();
                    break;
                case 'UnbanUser':
                    $this->unBanUser();
                    break;
                case 'ChangeUserRole':
                case "Disconnect":
                    $this->disconnect();
                    break;
                default:
                    $dataVueErreur[] = "Erreur d'appel PHP";
                    echo $twig->render("error.html", ['dVueError' => $dataVueErreur]);

            }
        }
        catch (PDOException $e){
                $dataVueErreur[] = "Erreur de BDD !";
                echo $twig->render("error.html",['dVueErreur' => $dataVueErreur]);
            }
        catch (Exception $e2){
                $dataVueErreur[] = "Erreur !";
                echo $twig->render("error.html",['dVueErreur' => $dataVueErreur]);
            }
    }

    public function gestionUser(){
        $mdl = new ModeleAdmin();
        $mdl->gestionUser();
    }

    public function banUser(){
        $mdl = new ModeleAdmin();
        $mdl->banUser();
    }

    public function unBanUser(){
        $mdl = new  ModeleAdmin();
        $mdl->unBanUser();
    }

    function disconnect(){
        $mdl = new ModeleAdmin();
        $mdl->disconnect();
    }

}