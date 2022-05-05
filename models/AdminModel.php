<?php

namespace Models;

class AdminModel
{
    private string $idAdmin;
    private string $adminLogin;
    private string $adminPW;
    private string $userId;


    /*public function __construct(string $id, string $userMail, string $userStatus)
    {
        $this->id = $id;
        $this->userMail = $userMail;
        $this->userStatus = $userStatus;
    } */

    public function getIdAdmin(): string
    {
        return $this->idAdmin;
    }

    public function getAdminLogin(): string 
    {
        return $this->adminLogin;
    }

    public function getAdminPW(): string
    {
        return $this->adminPW;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function setIdAdmin(string $idAdmin): void
    {
        $this->idAdmin = $idAdmin;
    }

    public function setAdminLogin(string $adminLogin): void
    {
        $this->adminLogin = $adminLogin;
    }

    public function setAdminPW(string $adminPW): void
    {
        $this->adminPW = $adminPW;
    }

    public function setUserId(string $userId): void
    {
        $this->userId = $userId;
    }

}

