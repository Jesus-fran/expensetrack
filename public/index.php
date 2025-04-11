<?php

use App\App;
use App\Router;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$router = new Router();
$router->get('/', ['App\Controllers\HomeController', 'index']);
$router->get('/test', fn() => 'Test from router!');
$router->post('/', fn() => 'posting data');


(new App($router, [$_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']]))->run();