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

        $postsRepository = new PostsRepository();
        $posts = $postsRepository->getAllPosts();

        return $this->twig->display('index.html.twig', [
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
        return $this->twig->display('register.html.twig');
    }

    public function page404()
    {
        $this->twig->display('page404.html.twig');
    }
}
