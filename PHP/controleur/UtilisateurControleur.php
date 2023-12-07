<?php

namespace controleur;

use Exception;
use modele\ModeleUtilisateur;
use Config\Validation;
use PDOException;


class UtilisateurControleur
{
    public function __construct(){
        global $twig;

        try{
            if(empty($_REQUEST["action"]))
            {
                $action = NULL;
            }
            else
            {
                $action = Validation::nettoyerString($_REQUEST["action"]);
            }
            switch ($action){
                case 'Disconnect':
                    $this->disconnect();
                    break;
                case 'ReportArticle':
                    $this->reportArticle();
                    break;
                case 'GoodReview':
                    $this->goodReview();
                    break;
                case 'BadReview':
                    $this->badReview();
                    break;
                case 'AccessForm':
                    $this->accessForm();
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
                case 'AccessAccount':
                    $this->accessAccount();
                    break;
                case 'ChangeEmail':
                    $this->changeEmail();
                    break;
                case 'ChangePassword':
                    $this->changePassword();
                    break;
                case 'DeleteProfil':
                    $this->deleteProfil();
                    break;
                default:
                    $dataVueErreur[] = "Erreur d'appel PHP";
                    echo $twig->render("error.html",['dVueError' => $dataVueErreur]);

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

    function disconnect(){
        $mdl = new ModeleUtilisateur();
        $mdl->disconnect();
    }

    function goodReview(){
        $mdl = new ModeleUtilisateur();
        $mdl->goodReview();
    }

    function badReview(){
        $mdl = new ModeleUtilisateur();
        $mdl->badReview();
    }

    function accessForm(){
        $mdl = new ModeleUtilisateur();
        $mdl->accessForm();
    }

    function accessAccount(){
        $mdl = new ModeleUtilisateur();
        $mdl->accessAccount();
    }

    function submitFormBug(){
        $mdl = new ModeleUtilisateur();
        $mdl->submitFormBug();
    }

    function submitFormArticle(){
        $mdl = new ModeleUtilisateur();
        $mdl->SubmitFormArticle();
    }

    function SubmitFormFakeNews(){
        $mdl = new ModeleUtilisateur();
        $mdl->SubmitFormFakeNews();
    }

    function reportArticle(){
        $mdl = new ModeleUtilisateur();
        $mdl->reportArticle();
    }

    function changeEmail(){

    }

    function changePassword(){

    }

    function deleteProfil(){
        $mdl = new ModeleUtilisateur();
        $mdl->deleteProfil();

    }
}