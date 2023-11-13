<?php

ini_set('display_errors', 'On'); ini_set('html_errors', 0); error_reporting(-1);

require(__DIR__ . '/gateways/UtilisateurGateway.php');

function redirect_by_path($path)
{
    $redirect = substr(strtr(realpath($path), '\\', '/'), strlen($_SERVER['DOCUMENT_ROOT']));
    header("location: $redirect");
    exit;
}

$username = "test";
$password = "test";

$dsn = "mysql:host=localhost;dbname=sae";

$con = new Connection($dsn, $username, $password);

$gw = new UtilisateurGateway($con);

$tab = $gw->findUserByPseudo($_POST['pseudo']);


$user = $tab[0];

if (password_verify($_POST['mdp'],$user->getMdp())) {
    session_start();
    $_SESSION['pseudo'] = $_POST['pseudo'];
    $_SESSION['mdp'] = $user->getMdp();
    $_SESSION['nom'] = $user->getNom();
    $_SESSION['prenom'] = $user->getPrenom();
    $_SESSION['mail'] = $user->getMail();
    $_SESSION['role'] = $user->getRole();
    echo "Session OK ! <br/>";
    // header('Location: /Verax/Vue/connexion.php');
    $redirect = redirect_by_path(__DIR__.'/../Vue/connexion.php');
    header("Location: $redirect");
}

else {
    echo "Pseudo ou mot de passe incorrect(s)";
}


?>


