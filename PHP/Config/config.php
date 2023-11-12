<?php

    /** Liste des modules à inclure */
    $dConfig['includes']=array('controleur/Validation.php');

    /** Variables pour la connexion à la base de données */
    global $dsn;
    global $login;
    global $mdp;
    $dsn="mysql:host=londres.uca.local;dbname="; //à compléter
    $login ="";
    $mdp="";

    /** Différentes vues */
    $vues['contact']='vues/contact.html';
    $vues['culture']='vues/culture.html';
    $vues['economie']='vues/economie.html';
    $vues['faitsdivers']='vues/faitsdivers.html';
    $vues['index']='vues/index.html';
    $vues['politique']='vues/politique.html';
    //à completer, erreur, connexion ...