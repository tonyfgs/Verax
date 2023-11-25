<?php

namespace modele;

class ModeleAdmin
{
    function isAdmin(){
        return !isset($_SESSION["role"]) || $_SESSION["role"] != 'Admin';
    }

    public function accessForm(){
        global $twig;
        echo $twig->render('contact.html', ["userRole" => $_REQUEST["role"]]);
    }

    public function disconnect(){
        global $twig;
        session_unset();
        $_SESSION["role"] = 'Visiteur';
        echo $twig->render('accueil.html', ["userRole" => $_SESSION["role"]]);
    }

}