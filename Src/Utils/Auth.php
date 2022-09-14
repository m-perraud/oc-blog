<?php

namespace Utils;

class Auth
{

    public $adminLogin;
    public $adminPW;
    public $loginPost;
    public $passwordPost;

    public function __construct($adminLogin, $adminPW, $loginPost, $passwordPost)
    {
        $this->adminLogin = $adminLogin;
        $this->adminPW = $adminPW;
        $this->loginPost = $loginPost;
        $this->passwordPost = $passwordPost;
    }


}