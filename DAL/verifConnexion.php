<?php

ini_set('display_errors', 'On'); ini_set('html_errors', 0); error_reporting(-1);

require(__DIR__.'/Gateways/UtilisateurGateway.php');

$username = "test";
$password = "test";

$dsn = "mysql:host=localhost;dbname=sae";

$con = new Connection($dsn, $username, $password);

$gw = new UtilisateurGateway($con);

$mdp = $gw->findPasswordByPseudo($_POST['pseudo']);


if (password_verify($_POST['mdp'],$mdp)) {
    session_start();
    $_SESSION['pseudo'] = $_POST['pseudo'];
    $_SESSION['mdp'] = $mdp;
    echo "Session OK ! <br/>";
    header('Location: /Verax/Vue/connexion.php');
}

else {
    echo "Pseudo ou mot de passe incorrect(s)";
}


?>


