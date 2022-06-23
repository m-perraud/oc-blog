<?php

namespace Controllers;

use Models\PostModel;
use Repository\UserRepository;
use Repository\PostsRepository;


class AdminController extends Controller
{

    public function dashAdmin()
    {
        $userRepository = new UserRepository(); 
        $users = $userRepository->findAllUsers();

        return $this->twig->display('dashboard.html.twig', [
            'users' => $users
        ]);
    }

    public function postsAdmin()
    {
        $postsRepository = new PostsRepository(); 
        $posts = $postsRepository->getAllPosts();

        return $this->twig->display('postsadmin.html.twig', [
            'posts' => $posts
        ]);
    }







    public function userManagement($adminLogin)
    {
        $adminLogin = $_POST['adminLogin'];

        $deleteAdmin = $_POST['delete'];
        //$addAdmin = $_POST['add'];

        $userRepository = new UserRepository();



    }













    public function editPost()
    {
        $id = 1;
        $postsRepository = new PostsRepository(); 
        $posts = $postsRepository->getOnePost($id);
/*
        $post = new PostModel();
        $post->setPostTitle($_POST['title'])
             ->setPostText($_POST['text']);
*/
        return $this->twig->display('editpost.html.twig', [
            'posts' => $posts
        ]);
    }



}
