<?php


use app\Controllers\HomeController;
use app\Controllers\PostController;
use app\Controllers\UserController;
use app\Router;

$router = new Router();

$router->addRoute('/', HomeController::class, 'index');
$router->addRoute('/login', UserController::class, 'login');
$router->addRoute('/register', UserController::class, 'register');
$router->addRoute('/logout', UserController::class, 'logout');
$router->addRoute('/posts', PostController::class, 'index');
$router->addRoute('/post', PostController::class, 'show');
$router->addRoute('/post/create', PostController::class, 'create');
$router->addRoute('/post/edit', PostController::class, 'edit');
$router->addRoute('/post/delete', PostController::class, 'delete');

return $router;
