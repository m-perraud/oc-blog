<?php

namespace Models;
class Admin
{
    public function getAdmin()
    {
        $database = new Database();
        $admins = $database->getPDO()->query('SELECT * FROM admin');

        return $admins;
    }
}