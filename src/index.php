<?php

require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/controllers/ProductController.php';

$router = new Router();


$router->add('GET', '/', [ProductController::class, 'index']);
$router->add('GET', '/create', [ProductController::class, 'create']);
$router->add('POST', '/store', [ProductController::class, 'store']);


$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);