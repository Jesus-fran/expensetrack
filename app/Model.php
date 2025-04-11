<?php

namespace App;

class Model
{
    /**
     * Summary of db
     * @var \PDO $db
     */
    protected DB $db;

    public function __construct()
    {
        $this->db = App::$db;
    }
}