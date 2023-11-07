<?php

require(__DIR__.'/Gateways/UtilisateurGateway.php');


try{
    $username = "test";
    $password = "test";
    $dsn = "mysql:host=localhost;dbname=sae";
    $con = new Connection($dsn, $username, $password);
    $gw = new UtilisateurGateway($con);
    if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $tab = $gw->findUserByPseudo($_POST['pseudo']);
        if (!empty($tab)) {
            header('Location: /Verax/Vue/inscription.php');
        }
        $verif = $gw->insert($_POST['pseudo'],$_POST['nom'],$_POST['prenom'],$_POST['mdp'],$_POST['mail']);
        if (!$verif) {
            header('Location: /Verax/Vue/inscription.php');
        }
        header('Location: /Verax/Vue/connexion.php'); 
    }else {
        echo "si";
    }
}
catch(PDOException $Exception) {
    echo "erreur";
    echo $Exception->getMessage();
}


?>