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

    public function findAllAdmins(): array
    {
        
        $sql = "SELECT * FROM user WHERE adminStatus = 1";
        $result = $this->getPDO()->query($sql);
        //dd($result->fetchAll());
        $users = $result->fetchAll(PDO::FETCH_CLASS, UserModel::class);
        return $users;
    }

    public function findOneUser($adminId)
    {
        $sql = "SELECT * FROM user WHERE ID = $adminId";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchObject(UserModel::class);
        return $posts;
    }

    public function verifyAdminLogin($loginPost)
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
        (\"$registerMail\", \"$registerLogin\", \"$registerPW\" )";

        $result = $this->getPDO()->query($sql);
        //dd($result->fetchAll());
        $user = $result->fetchAll(PDO::FETCH_CLASS, UserModel::class);
        //return $result->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    public function updateAdmin($adminId)
    {

        $sql = "UPDATE user SET adminStatus = (CASE adminStatus WHEN 1 THEN 0 ELSE 1 END) 
        WHERE id = $adminId";
        $result = $this->getPDO()->query($sql);
        //dd($result->fetchAll());
        $user = $result->fetchAll(PDO::FETCH_CLASS, UserModel::class);
        //return $result->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }
}
