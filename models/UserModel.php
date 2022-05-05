<?php

namespace Models;

class UserModel
{
    private string $id;
    private string $userMail;
    private string $userStatus;


    /*public function __construct(string $id, string $userMail, string $userStatus)
    {
        $this->id = $id;
        $this->userMail = $userMail;
        $this->userStatus = $userStatus;
    } */

    public function getId(): string
    {
        return $this->id;
    }

    public function getUserMail(): string 
    {
        return $this->userMail;
    }

    public function getUserStatus(): string
    {
        return $this->userStatus;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setUserMail(string $userMail): void
    {
        $this->userMail = $userMail;
    }

    public function setUserStatus(string $userStatus): void
    {
        $this->userStatus = $userStatus;
    }

}

