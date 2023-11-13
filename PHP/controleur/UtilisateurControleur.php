<?php

namespace controleur;

class UtilisateurControleur
{
    public function __construct(){
        global $twig;
        session_start();

        try{
            if(empty($_REQUEST["action"]))
            {
                $action = NULL;
            }
            else
            {
                $action = \Validation::nettoyerString($_REQUEST["action"]);
            }
            switch ($action){
                case NULL:

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
                    echo $twig->render("../Vue/error.html",['dVueError' => $dataVueErreur]);

            }
        }
        catch (PDOException $e){
            $dataVueErreur[] = "Erreur de BDD !";
            require("../Vue/error.php");
        }
        catch (Exception $e2){
            $dataVueErreur[] = "Erreur !";
            require("../Vue/error.php");
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

    function accessAccount(){
        $mdl = new ModeleUtilisateur();
        $mdl->accessAccount();
    }

}