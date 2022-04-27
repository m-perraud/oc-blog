<?php 

namespace Controllers; 

use Models\User;
use Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $this->twig->display('index.html.twig');

        $userModel = new User();
        $users = $userModel->getUser();

        foreach($users->fetchAll() as $user)
        {
            dump($user);
        }
    }

    public function about()
    {
        $this->twig->display('about.html.twig');
    }

    public function login()
    {
        $this->twig->display('login.html.twig');
    }

    public function register()
    {
        $this->twig->display('register.html.twig');
    }

    public function page404()
    {
        $this->twig->display('page404.html.twig');
    }
}
