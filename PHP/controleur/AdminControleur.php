<?php

namespace controleur;

use dal\gateways\ArticleGateway;
use dal\gateways\UtilisateurGateway;

class AdminControleur
{
    public function __construct()
    {
        global $twig;
        session_start();

        try {
            if (empty($_REQUEST["action"])) {
                $action = NULL;
            } else {
                $action = \Validation::nettoyerString($_REQUEST["action"]);
            }
            switch ($action) {
                case NULL:
                case 'accueil':
                    break;
                case 'GestionUser':
                    $this->gestionUser();
                    break;
                case 'BanUser':
                case 'UnbanUser':
                case 'ChangeUserRole':
                default:
                    $dataVueErreur[] = "Erreur d'appel PHP";
                    echo $twig->render("../Vue/error.html", ['dVueError' => $dataVueErreur]);

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
        global $twig;
        $gw = new UtilisateurGateway();
        echo $twig->render('adminUserList.html', ['utilisateurs' => $gw->findAllUser()]);
    }
}