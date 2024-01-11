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
                case 'Administrer':
                    $this->administrer();
                    break;
                case 'GestionUser':
                    $this->gestionUser();
                    break;
                case 'SujetSoumis':
                    $this->sujetSoumis();
                    break;
                case 'BanUser':
                    $this->banUser();
                    break;
                case 'UnbanUser':
                    $this->unBanUser();
                    break;
                case 'ChangeUserRole':
                    $this->changeUserRole();
                    break;
                case "Disconnect":
                    $this->disconnect();
                    break;
                case 'AccessForm':
                    $this->accessForm();
                    break;
                case 'AccessAccount':
                    $this->accessAccount();
                    break;
                case 'SubmitFormFakeNews':
                    $this->SubmitFormFakeNews();
                    break;
                case 'SubmitFormArticle':
                    $this->submitFormArticle();
                    break;
                case 'SubmitFormBug':
                    $this->submitFormBug();
                    break;
                case 'ListReport':
                    $this->listReport();
                    break;
                case "ReportArticle":
                    $this->reportArticle();
                    break;
                case "Api":
                    $this->api();
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

    function changeUserRole(){
        $mdl = new ModeleAdmin();
        $mdl->changeUserRole();
    }

    function administrer()
    {
        $mdl = new ModeleAdmin();
        $mdl->administrer();
    }

    function accessForm(){
        $mdl = new ModeleAdmin();
        $mdl->accessForm();
    }

    function accessAccount(){
        $mdl = new ModeleAdmin();
        $mdl->accessAccount();
    }

    function submitFormBug(){
        $mdl = new ModeleAdmin();
        $mdl->submitFormBug();
    }

    function submitFormArticle(){
        $mdl = new ModeleAdmin();
        $mdl->SubmitFormArticle();
    }

    function SubmitFormFakeNews(){
        $mdl = new ModeleAdmin();
        $mdl->SubmitFormFakeNews();
    }

    function sujetSoumis(){
        $mdl = new ModeleAdmin();
        $mdl->getAllForm();
    }

    function listReport(){
        $mdl = new ModeleAdmin();
        $mdl->listReport();
    }

    function reportArticle(){
        $mdl = new ModeleUtilisateur();
        $mdl->reportArticle();
    }

    function api() {
        $mdl = new ModeleAdmin();
        $mdl->api();
    }

}