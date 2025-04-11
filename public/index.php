<?php

use App\App;
use App\Router;

require __DIR__ . '/../vendor/autoload.php';

define('PATH_VIEW', __DIR__ . '/../views/');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$router = new Router();
$router->get('/', ['App\Controllers\HomeController', 'index']);
$router->get('/create', ['App\Controllers\HomeController', 'create']);
$router->post('/upload', ['App\Controllers\HomeController', 'save']);

(new App($router, [$_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']]))->run();