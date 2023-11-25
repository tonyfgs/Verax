<?php

namespace controleur;

use Exception;
use modele\ModeleUtilisateur;
use Config\Validation;

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
                case 'GoodReview':
                    $this->goodReview();
                    break;
                case 'BadReview':
                    $this->badReview();
                    break;
                case 'AccessForm':
                    $this->accessForm();
                    break;
                case 'SubmitForm':
                    $this->submitForm();
                    break;
                case 'ReportArticle':
                    $this->reportArticle();
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
                case 'DeleteAccount':
                    $this->deleteAccount();
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
        $mdl->goodReview('');
    }

    function badReview(){
        $mdl = new ModeleUtilisateur();
        $mdl->badReview('');
    }

    function accessForm(){
        $mdl = new ModeleUtilisateur();
        $mdl->accessForm();
    }

    function accessAccount(){
        $mdl = new ModeleUtilisateur();
        $mdl->accessAccount();
    }


    function submitForm(){
        $mdl = new ModeleUtilisateur();
        $mdl->submitForm();
    }

    function reportArticle(){

    }

    function changeEmail(){

    }

    function changePassword(){

    }

    function deleteAccount(){

    }
}