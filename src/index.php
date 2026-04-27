<?php

session_start();

require_once __DIR__ . '/core/Router.php';
require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/PurchaseController.php';
require_once __DIR__ . '/controllers/AuthController.php';

$router = new Router();

$router->add('GET', '/', [ProductController::class, 'index']);
$router->add('GET', '/create', [ProductController::class, 'create']);
$router->add('POST', '/store', [ProductController::class, 'store']);

$router->add('GET', '/purchases', [PurchaseController::class, 'index']);
$router->add('GET', '/purchases/create', [PurchaseController::class, 'create']);
$router->add('POST', '/purchases/store', [PurchaseController::class, 'store']);

$router->add('GET', '/login', [AuthController::class, 'loginForm']);
$router->add('POST', '/login', [AuthController::class, 'login']);
$router->add('GET', '/register', [AuthController::class, 'registerForm']);
$router->add('POST', '/register', [AuthController::class, 'register']);
$router->add('GET', '/logout', [AuthController::class, 'logout']);
$router->add('GET', '/profile', [AuthController::class, 'profile']);

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);