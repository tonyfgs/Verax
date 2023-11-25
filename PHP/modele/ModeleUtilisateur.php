<?php

namespace modele;
use dal\Connection;
use dal\gateways\FormulaireGateway;
use dal\gateways\NoteGateway;
use dal\gateways\UtilisateurGateway;
use metier\Utilisateur;

class ModeleUtilisateur
{

    public function isUser(){
        return !isset($_SESSION["role"]) || $_SESSION["role"] != 'Utilisateur';
    }
    public function disconnect(){
        session_unset();
    }

    public function goodReview($idArticle){
        global $dsn, $login, $mdp;
        $gw = new NoteGateway(new Connection($dsn, $login, $mdp));
        $note = $gw->getNoteByUserOnArticle($_SESSION[], $idArticle);
        if ($note == 0){
            $gw->insertNote($idArticle,$_SESSION["pseudo"], 1);
        }
        elseif ($note == 1){
            $gw->deleteNote($idArticle, $_SESSION["pseudo"]);
        }
        else {
            $gw->updateNote($idArticle, $_SESSION["pseudo"], 1);
        }

    }

    public  function badReview($idArticle){
        global $dsn, $login, $mdp;
        $gw = new NoteGateway(new Connection($dsn, $login, $mdp));
        $note = $gw->getNoteByUserOnArticle($_SESSION["pseudo"], $idArticle);
        if ($note == 0){
            $gw->insertNote($idArticle,$_SESSION["pseudo"], -1);
        }
        elseif ($note == -1){
            $gw->deleteNote($idArticle, $_SESSION["pseudo"]);
        }
        else {
            $gw->updateNote($idArticle, $_SESSION["pseudo"], -1);
        }
    }

    public function accessForm(){
        global $twig;
        echo $twig->render('contact.html', ['userRole' => $_SESSION["role"]]);
    }

    public function accessAccount(){
        global $dsn, $login, $mdp, $twig;
        echo "1";
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        echo "2";
        echo $_SESSION['pseudo'];
        $User = $gw->findUserByPseudo($_SESSION['pseudo']);
        echo "3";
        echo $twig->render('CompteUtilisateur.html', ['utilisateur' => $User]);
    }

    public function submitForm(){
        global $dsn, $login, $mdp;
        $gw = new FormulaireGateway(new Connection($dsn, $login, $mdp));

    }
}