<?php

require_once  __DIR__ . '/config/config.php';
require __DIR__ . '/config/autoloader.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../Vue');
$twig = new Twig\Environment($loader, [ 'cache' => false, ]);

$controleur = new FrontControler();