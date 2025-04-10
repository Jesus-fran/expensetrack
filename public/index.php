<?php

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

echo "Hello World! <br/>";

$dsn = $_ENV['DB_DRIVER'] . ':dbname=' . $_ENV['DB_DATABASE'] . ';host=' . $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
try {
    $pdo = new PDO($dsn, $user, $pass);
} catch (\PDOException $e) {
    echo 'Failed: ' . $e->getMessage();
}

var_dump($pdo);