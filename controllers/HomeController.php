<?php 

namespace Controllers; 

use Controllers\Controller;
use Repository\UserRepository;
use Repository\PostsRepository;

class HomeController extends Controller
{

    public function index()
    {
        // On créé un nouveau UserRepository
        $userRepository = new UserRepository();
        $postsRepository = new PostsRepository();

        // On cherche la liste des users dans le userrepository
        $users = $userRepository->findAllUsers();
        $posts = $postsRepository->getAllPosts();
        

        // On injecte dans la page index.html.twig, dans la variable 
        // 'user' le contenu de la liste $users
        return $this->twig->display('index.html.twig', [
            'users' => $users,
            'toto' => 'ceci est une string', 
            'posts' => $posts
        ]);
    }

    public function about()
    {
        $postsRepository = new PostsRepository(); 
        $posts = $postsRepository->getLastPosts();

        return $this->twig->display('about.html.twig', [
            'posts' => $posts
        ]);
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
