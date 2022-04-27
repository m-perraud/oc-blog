<?php

namespace Models;
class User
{
    public function getUser()
    {
        $database = new Database();
        $users = $database->getPDO()->query('SELECT * FROM user');

        return $users;
    }
}