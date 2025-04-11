<?php

namespace App;

use PDO;

class DB
{
    private PDO $pdo;

    public function __construct()
    {
        $dsn = $_ENV['DB_DRIVER'] . ':dbname=' . $_ENV['DB_DATABASE'] . ';host=' . $_ENV['DB_HOST'];
        try {
            $this->pdo = new PDO(
                $dsn,
                $_ENV['DB_USER'],
                $_ENV['DB_PASS'],
                [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]
            );
        } catch (\PDOException $e) {
            echo 'Failed conexion: ' . $e->getMessage();
        }
    }

    public function __call($method, $args)
    {
        return $this->pdo->$method(...$args);
    }
}