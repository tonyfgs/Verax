<?php

namespace controleur;

use dal\Connection;
use dal\gateways\ArticleGateway;
use dal\gateways\UtilisateurGateway;
use Config\Validation;

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
                case NULL:
                case 'accueil':
                    break;
                case 'GestionUser':
                    $this->gestionUser();
                    break;
                case 'BanUser':
                    $this->banUser();
                    break;
                case 'UnbanUser':
                case 'ChangeUserRole':
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
        global $twig, $dsn, $login, $mdp;
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        $tab = $gw->findAllUser();
        $tab2 = array();
        foreach ($tab as $t){
            if ($t->getRole() != 'A'){
                $tab2[] = $t;
            }
        }
        echo $twig->render('adminUserList.html', ['utilisateurs' => $tab2]);
    }

    public function banUser(){
        global $dsn, $login, $mdp, $twig;
        $id = $_POST['id'];
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        $verif = $gw->delete($id);
        if($verif){
            echo "Suppression de réussi";
        }
        else{
            echo "Suppression de échoué";
        }
        $this->gestionUser();
    }

}