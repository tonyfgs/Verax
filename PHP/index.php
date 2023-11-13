<?php

use controleur\FrontControler;

require_once __DIR__ . '/config/config.php';
require __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('Vue');
$twig = new Twig\Environment($loader, [ 'cache' => false, ]);

session_start();

$cont = new FrontControler();