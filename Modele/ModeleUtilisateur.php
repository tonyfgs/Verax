<?php

namespace Modele;

use Connection;
use NoteGateway;

class ModeleUtilisateur
{
    public function disconnect(){
        session_destroy();
    }

    public function goodReview($idArticle){
        global $dsn, $login, $mdp;
        $gw = new NoteGateway(new Connection($dsn, $login, $mdp));
        $note = $gw->getNoteByUserOnArticle($_SESSION["login"], $idArticle);
        if ($note == 0){
            $gw->insertNote($idArticle,$_SESSION["login"], 1);
        }
        elseif ($note == 1){
            $gw->deleteNote($idArticle, $_SESSION["login"]);
        }
        else {
            $gw->updateNote($idArticle, $_SESSION["login"], 1);
        }

    }

    public  function badReview($idArticle){
        global $dsn, $login, $mdp;
        $gw = new NoteGateway(new Connection($dsn, $login, $mdp));
        $note = $gw->getNoteByUserOnArticle($_SESSION["login"], $idArticle);
        if ($note == 0){
            $gw->insertNote($idArticle,$_SESSION["login"], -1);
        }
        elseif ($note == -1){
            $gw->deleteNote($idArticle, $_SESSION["login"]);
        }
        else {
            $gw->updateNote($idArticle, $_SESSION["login"], -1);
        }
    }
}