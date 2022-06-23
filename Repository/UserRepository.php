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

    public function verifyAdminLogin($loginPost, $passwordPost)
    {
        $sql = "SELECT * FROM user WHERE adminLogin = \"$loginPost\"";
        $result = $this->getPDO()->query($sql);
        //dd($result->fetchAll());
        $user = $result->fetchAll(PDO::FETCH_CLASS, UserModel::class);
        //return $result->fetchAll(PDO::FETCH_ASSOC);
        return $user; 
    }

    public function registerUser($registerLogin, $registerPW, $registerMail)
    {

        $sql = "INSERT INTO user (`userMail`, `adminLogin`, `adminPW`) 
        VALUES 
        (\"$registerLogin\", \"$registerPW\", \"$registerMail\")";

        $result = $this->getPDO()->query($sql);
        //dd($result->fetchAll());
        $user = $result->fetchAll(PDO::FETCH_CLASS, UserModel::class);
        //return $result->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    public function updateAdmin($adminLogin)
    {
        $sql = "UPDATE user SET adminStatus = 0 WHERE adminLogin = $adminLogin";

        $result = $this->getPDO()->query($sql);
        //dd($result->fetchAll());
        $user = $result->fetchAll(PDO::FETCH_CLASS, UserModel::class);
        //return $result->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }
}
