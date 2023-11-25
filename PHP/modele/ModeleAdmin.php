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

}