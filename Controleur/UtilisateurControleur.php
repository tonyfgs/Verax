<?php

namespace Controleur;

use Modele\ModeleUtilisateur;
use MongoDB\Driver\Exception\Exception;

class UtilisateurControleur
{
    public function __construct(){
        session_start();

        try{
            if(!isset($_REQUEST["action"]))
            {
                $action = NULL;
            }
            else
            {
                //nettoyage de l'action (validation)
            }
            $action=$_REQUEST['action'];
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

            }
        }
        catch (PDOException $e){
            $dataVueErreur[] = "Erreur de BDD !";
            require("../Vue/erreur.php");
        }
        catch (Exception $e2){
            $dataVueErreur[] = "Erreur !";
            require("../Vue/erreur.php");
        }
    }

    function disconnect(){
        $mdl = new ModeleUtilisateur();
        $mdl->disconnect();
        // new VisiteurControler();
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
}