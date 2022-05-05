<?php 

namespace Controllers; 

use Models\UserModel;
use Controllers\Controller;
use Repository\UserRepository;

class HomeController extends Controller
{

    public function index()
    {
        // On créé un nouveau UserRepository
        $userRepository = new UserRepository();
        // On cherche la liste des users dans le userrepository
        $users = $userRepository->findAllUsers();
        
        // On injecte dans la page index.html.twig, dans la variable 
        // 'user' le contenu de la liste $users
        return $this->twig->render('index.html.twig', [
            'users' => $users,
            'toto' => 'ceci est une string'
        ]);
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
