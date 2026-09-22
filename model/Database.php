<?php

namespace Model;

use PDO;

class Database
{
    public ?PDO $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new PDO("mysql:host={$_ENV["DB_HOST"]};dbname={$_ENV["DB_NAME"]}",
        $_ENV["DB_USER"], $_ENV["DB_PASSWORD"]);
    }

    public function getConnection(): PDO
    {
        return $this->dbConnection;
    }

    public function __destruct()
    {
        $this->dbConnection = null;
    }
}