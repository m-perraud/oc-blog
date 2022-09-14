<?php

namespace Models;

use Utils\Constant;



class Database
{
    
    private static \PDO $pdo;

    public function __construct()
    {
        try {
            static::$pdo = new \PDO('mysql:host=' . Constant::DB_HOST . ';dbname=' . Constant::DB_NAME , Constant::DB_USERNAME , Constant::DB_PASSWORD, [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ]);
        } catch (\PDOException $e)
        {
            die($e->getMessage());
        }
    }

    public function getPDO(): \PDO
    {
        return static::$pdo;
        //return self::$pdo;
    }
}