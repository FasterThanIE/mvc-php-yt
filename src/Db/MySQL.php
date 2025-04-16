<?php

namespace Src\Db;

use PDO;

class MySQL
{
    protected readonly PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            dsn: "mysql:host=" . $_ENV['DB_HOST'] . ";dbname=" . $_ENV['DB_DATABASE'],
            username: $_ENV['DB_USER'],
            password: $_ENV['DB_PASSWORD']
        );
    }
}