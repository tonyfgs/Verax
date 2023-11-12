<?php

require_once  __DIR__ . '/config/config.php';
require __DIR__ . '/vendor/autoloader.php';

$loader = new \Twig\Loader\FilesystemLoader('Vue');
$twig = new Twig\Environment($loader, [ 'cache' => false, ]);

$controleur = new FrontControler();