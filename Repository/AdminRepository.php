<?php

namespace Repository;

use PDO;
use Models\Database;
use Models\AdminModel;

class AdminRepository extends Database
{
    public function findAllAdmins()
    {
        $sql = "SELECT * FROM admin";
        $result = $this->getPDO()->query($sql);
        //dd($result->fetchAll());
        $admins = $result->fetchAll(PDO::FETCH_CLASS, AdminModel::class);
        return $admins;
    }
}