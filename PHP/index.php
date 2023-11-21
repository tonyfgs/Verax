<?php

use controleur\FrontControler;

require_once  __DIR__ .'/config/config.php';
require_once __DIR__ .'router.php';
require __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/Vue');
$twig = new Twig\Environment($loader, [ 'cache' => false, 'debug' => true ]);

$router = new Router();
$router->route();

$cont = new FrontControler();