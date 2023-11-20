<?php

namespace modele;
use dal\Connection;
use dal\gateways\FormulaireGateway;
use dal\gateways\NoteGateway;
use dal\gateways\UtilisateurGateway;
use metier\Utilisateur;

class ModeleUtilisateur
{
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
        echo $twig->render('contact.html', []);
    }

    public function accessAccount() : ?Utilisateur{
        $gw = new UtilisateurGateway();
        $User = $gw->findUserByPseudo($_SESSION['pseudo']);
        return $User[0];
    }

    public function submitForm(){
        global $dsn, $login, $mdp;
        $gw = new FormulaireGateway(new Connection($dsn, $login, $mdp));

    }
}