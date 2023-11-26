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
        return (!isset($_SESSION["role"]) || $_SESSION["role"] != 'Utilisateur');
    }
    public function disconnect(){
        global $twig;
        session_unset();
        $_SESSION["role"] = "Visiteur";
        echo $twig->render('accueil.html', ["userRole" => $_SESSION["role"]]);
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
        global $twig, $dsn, $mdp, $login;
        $gw = new UtilisateurGateway(new Connection($dsn, $login,$mdp));
        if ($gw->isBan($_SESSION["pseudo"])){
            echo  $twig->render('error.html', ['dVueErreur' => array('Vous n êtes plus autorisée à faire cette action pour le moment !')]);
        }
        else {
            echo $twig->render('contact.html', ['userRole' => $_SESSION["role"]]);
        }
    }

    public function accessAccount(){
        global $dsn, $login, $mdp, $twig;
        $gw = new UtilisateurGateway(new Connection($dsn, $login, $mdp));
        $User = $gw->findUserByPseudo($_SESSION['pseudo']);
        echo $twig->render('CompteUtilisateur.html', ['utilisateur' => $User[0], 'userRole' => $_SESSION["role"] ]);
    }

    public function  submitFormBug(){
        global $dsn, $login, $mdp, $twig;
        $gw = new FormulaireGateway(new Connection($dsn, $login, $mdp));
        $result =  mail("Tony.FAGES@etu.uca.fr","Bug Report",$_POST["champ3-1"]);
        echo $twig->render('contact.html', ['userRole' => $_SESSION["role"]]);

    }

    public function SubmitFormFakeNews() {
        global $dsn, $login, $mdp, $twig;
        $gw = new FormulaireGateway(new Connection($dsn, $login, $mdp));

        // Vérifier si les clés existent dans $_POST
        $champ1_1 = isset($_POST['champ1-1']) ? $_POST['champ1-1'] : null;
        $champ1_2 = isset($_POST['champ1-2']) ? $_POST['champ1-2'] : null;
        $champ1_3 = isset($_POST['champ1-3']) ? $_POST['champ1-3'] : null;
        $result = $gw->insertFormFakeNews($champ1_1, $champ1_2, $champ1_3,$_SESSION["pseudo"]);
        if ($result){
            echo $_SESSION["pseudo"];
            echo " envoie du formulaire confirmer merci pour votre contribution";
        }
        else {
            echo "Erreur envoie du formulaire";

        }
        echo $twig->render('accueil.html', ["userRole" => $_SESSION["role"]]);

    }


    public function   SubmitFormArticle(){
        global $dsn, $login, $mdp, $twig;
        $gw = new FormulaireGateway(new Connection($dsn, $login, $mdp));
        echo "1";
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            echo "2";
            $result = $gw->insertFormMessage($_POST['pseudo'],$_POST['email'],$_POST['name'],$_POST['surname']);
            echo $twig->render('contact.html', ['userRole' => $_SESSION["role"]]);
        }
    }
}