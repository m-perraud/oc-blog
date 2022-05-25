<?php

namespace Repository;

use PDO;
use Models\Database;
use Models\UserModel;

class UserRepository extends Database
{
    public function findAllUsers(): array
    {
        $sql = "SELECT * FROM user";
        $result = $this->getPDO()->query($sql);
        //dd($result->fetchAll());
        $users = $result->fetchAll(PDO::FETCH_CLASS, UserModel::class);
        return $users;
    }

}
