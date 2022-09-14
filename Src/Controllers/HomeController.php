<?php 

namespace Controllers; 

use Models\UserModel;
use Controllers\Controller;
use Repository\UserRepository;
use Repository\PostsRepository;

class HomeController extends Controller
{

    public function index()
    {
        return $this->twig->display('index.html.twig');
    }



    public function login()
    {
        $this->twig->display('login.html.twig');
    }

    public function register()
    {
        return $this->twig->display('register.html.twig');
    }

    public function page404()
    {
        $this->twig->display('page404.html.twig');
    }

    public function page403()
    {
        $this->twig->display('page403.html.twig');
    }

    public function page500()
    {
        $this->twig->display('page500.html.twig');
    }
}
