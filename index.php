<?php

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../Vue');
$twig = new Twig\Environment($loader, [ 'cache' => false, ]);

$controleur = 'new FrontControler()';
