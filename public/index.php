<?php
require 'vendor/autoload.php';
session_start();
$uri = $_SERVER['REQUEST_URI'];
$router = require 'app/routes.php';
$router->dispatch($uri);
