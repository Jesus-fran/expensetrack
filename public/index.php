<?php

use App\App;
use App\Exceptions\NotFoundException;
use App\Router;
use App\View;

require __DIR__ . '/../vendor/autoload.php';

define('PATH_VIEW', __DIR__ . '/../views/');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$router = (new Router())->get('/', ['App\Controllers\HomeController', 'index'])
    ->get('/create', ['App\Controllers\HomeController', 'create'])
    ->post('/upload', ['App\Controllers\HomeController', 'save'])
    ->get('/404', fn() => View::make('errors/404.php', [], 'layout.php'))
    ->get('/invoices', ['App\Controllers\InvoiceController', 'index']);

try {
    (new App(
        $router,
        [$_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']]
    ))->run();
} catch (NotFoundException $e) {
    if ($e->getCode() === 404) {
        header('Location: /404');
    }
}