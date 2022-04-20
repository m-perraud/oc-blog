<?php

namespace Models;

use Source\Constant;

class User
{
    private static \PDO $pdo;

    public function __construct()
    {
        try {
            static::$pdo = new \PDO('mysql:host=' . Constant::DB_HOST . ';dbname=' . Constant::DB_NAME , Constant::DB_USERNAME , Constant::DB_PASSWORD);
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