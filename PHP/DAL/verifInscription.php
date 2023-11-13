<?php

require(__DIR__.'/Gateways/UtilisateurGateway.php');

function redirect_by_path($path)
{
    $redirect = substr(strtr(realpath($path), '\\', '/'), strlen($_SERVER['DOCUMENT_ROOT']));
    header("location: $redirect");
    exit;
}


try{
    $username = "test";
    $password = "test";
    $dsn = "mysql:host=localhost;dbname=sae";
    $con = new Connection($dsn, $username, $password);
    $gw = new UtilisateurGateway($con);
    if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        $tab = $gw->findUserByPseudo($_POST['pseudo']);
        if (!empty($tab)) {
            $redirect = redirect_by_path(__DIR__.'/../Vue/inscription.php');
            header("Location: $redirect");
        }
        $verif = $gw->insert($_POST['pseudo'],$_POST['nom'],$_POST['prenom'],$_POST['mdp'],$_POST['mail'],'U');
        if (!$verif) {
            $redirect = redirect_by_path(__DIR__.'/../Vue/inscription.php');
            header("Location: $redirect");
        }
        $redirect = redirect_by_path(__DIR__.'/../Vue/connexion.php');
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