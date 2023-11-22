<?php

namespace modele;

class ModeleAdmin
{
    function isAdmin(){
        return !isset($_SESSION["role"]) || $_SESSION["role"] != 'Admin';
    }

}