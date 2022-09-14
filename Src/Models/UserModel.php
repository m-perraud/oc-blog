<?php

namespace Models;

class UserModel
{
    private string $id;
    private string $userMail;
    private string $adminLogin;
    private string $adminPW;
    private string $adminStatus;


    public function getId(): string
    {
        return $this->id;
    }

    public function getUserMail(): string 
    {
        return $this->userMail;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setUserMail(string $userMail): void
    {
        $this->userMail = $userMail;
    }

    public function getAdminLogin(): string 
    {
        return $this->adminLogin;
    }

    public function getAdminPW(): string
    {
        return $this->adminPW;
    }

    public function getAdminStatus(): string
    {
        return $this->adminStatus;
    }

    public function setAdminLogin(string $adminLogin): void
    {
        $this->adminLogin = $adminLogin;
    }

    public function setAdminPW(string $adminPW): void
    {
        $this->adminPW = $adminPW;
    }

    public function setAdminStatus(string $adminStatus): void
    {
        $this->userId = $adminStatus;
    }

}

