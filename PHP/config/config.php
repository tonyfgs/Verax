<?php
    namespace config;
    /** Liste des modules à inclure */
    $dConfig['includes']=array('controleur/Validation.php');

    /** Variables pour la connexion à la base de données */
    global $dsn;
    global $login;
    global $mdp;
    $dsn="mysql:host=localhost;dbname=verax";
    $login = "test";
    $mdp = "test";


    /** Différentes vues */
    $vues['accueil']='../Vue/accueil.html';
    $vues['contact']='../Vue/contact.html';
    $vues['culture']='../Vue/culture.html';
    $vues['economie']='../Vue/economie.html';
    $vues['faitsdivers']='../Vue/faitsDivers.html';
    $vues['index']='../Vue/index.html';
    $vues['politique']='../Vue/politique.html';
    //à completer, erreur, connexion ...