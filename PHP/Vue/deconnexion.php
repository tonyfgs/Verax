<?php

session_start();

function redirect_by_path($path)
{
    $redirect = substr(strtr(realpath($path), '\\', '/'), strlen($_SERVER['DOCUMENT_ROOT']));
    header("location: $redirect");
    exit;
}

if (isset($_SESSION)) {
    session_unset();
}

$redirect = redirect_by_path(__DIR__.'/../Vue/connexion.php');
header("Location: $redirect");





?>