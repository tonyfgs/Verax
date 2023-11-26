<?php
namespace dal;
use dal\gateways\UtilisateurGateway;
use dal\Connection;

try{
    $username = "";
    $password = "";
    $dsn = "mysql:host=localhost;dbname=Verax";
    $con = new Connection($dsn, $username, $password);
    $gw = new UtilisateurGateway($con);
    if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $tab = $gw->findUserByPseudo($_POST['pseudo']);
        if (!empty($tab)) {
            $redirect = 'Vue/inscription.html';
            header("Location: $redirect");
        }
        $verif = $gw->insert($_POST['pseudo'],$_POST['nom'],$_POST['prenom'],$_POST['mdp'],$_POST['mail'],'U');
        if (!$verif) {
            $redirect = 'Vue/inscription.html';
            header("Location: $redirect");
        }
        $redirect = 'Vue/connexion.html';
        header("Location: $redirect");
    }else {
        echo "si";
    }
}
catch(PDOException $Exception) {
    echo "erreur";
    echo $Exception->getMessage();
}


?>