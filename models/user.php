<?php

namespace Models;

use Source\Constant;

class User
{
    private static \PDO $pdo;

    public function __construct()
    {
        try {
            static::$pdo = new \PDO('
            mysql:dbname=' . Constant::DB_NAME . ';host:host' . Constant::DB_NAME, 
            Constant::DB_USERNAME,
            Constant::DB_PASSWORD,
            [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]);
        } catch (\PDOException $e)
        {
            echo $e->getMessage(); 
            die();
        }
    }

    public function getPDO(): \PDO
    {
        return static::$pdo;
    }
}