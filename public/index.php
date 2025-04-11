<?php

use App\Router;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$router = new Router();
$router->get('/', fn() => 'Home from router!');
$router->get('/test', fn() => 'Test from router!');
$router->post('/', fn() => 'posting data');

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
echo $router->resolve($requestUri, $requestMethod);