<?php

namespace Controllers;

use Repository\UserRepository;
use Repository\PostsRepository;
use Repository\CommentsRepository;


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


    public function userManagement($adminId)
    {
        $adminId = $_POST['adminId'];
        $deleteAdmin = $_POST['delete'];

        $userRepository = new UserRepository();

        $user = $userRepository->findOneUser($adminId);


        if (isset($deleteAdmin)) {
            $userRepository->updateAdmin($adminId);
            $users = $userRepository->findAllUsers();
            return header('Location: /dashboard');
        }

        $error = 'L\'opération n\'a pas pu être effectuée.';
        return $this->twig->display(
            'dashboard.html.twig',
            [
                'error' => $error
            ]
        );
    }

    public function updatePost()
    {
        $postId = $_POST['postId'];
        $titlePost = $_POST['title'];
        $textPost = $_POST['text'];
        $urlPost = $_POST['URL'];

        $postsRepository = new PostsRepository();

        if (isset($titlePost) &&  isset($textPost) && isset($urlPost)) {
                $postsRepository->updatePost($titlePost, $textPost, $urlPost, $postId);
                $posts= $postsRepository->getAllPosts();

                $success = 'L\'opération a bien pu être effectuée.';
                return header('Location: /postsadmin');
            }


            /* PROBLEME SUR LA REMONTEE D ERREURS A VOIR */
            
            $error = 'L\'opération n\'a pas pu être effectuée. 
            Merci de vérifier que tous les champs sont remplis.';

            return $this->twig->display('editpost.html.twig', [
                'error' => $error
            ]);
        }

    public function deletePost()
    {
        $postId = $_POST['postId'];
        $deletePost = $_POST['delete'];

        $postsRepository = new PostsRepository();

        $post = $postsRepository->getOnePost($postId);

        if (isset($deletePost)) {
            $postsRepository->deletePost($postId);
            $posts = $postsRepository->getAllPosts();
            return header('Location: /postsadmin');
        }

        $error = 'L\'opération n\'a pas pu être effectuée.';
        return $this->twig->display('postsadmin.html.twig', [
            'error' => $error
        ]);
    }

    public function editPost($id)
    {
        $postsRepository = new PostsRepository();
        $posts = $postsRepository->getOnePost($id);

        return $this->twig->display('editpost.html.twig', [
            'posts' => $posts
        ]);
    }

    public function commentAdmin()
    {
        $commentsRepository = new CommentsRepository();
        $comments = $commentsRepository->findAllComments();

        return $this->twig->display('commentadmin.html.twig', [
            'comments' => $comments
        ]);
    }


    public function validateComment($id)
    {

    }

    public function deleteComment()
    {
        $commentId = $_POST['commentId'];
        $deleteComment = $_POST['delete'];

        $commentsRepository = new CommentsRepository();

        $comment = $commentsRepository->getOneComment($commentId);

        if (isset($deleteComment)) {
            $commentsRepository->deleteComment($commentId);
            $comments = $commentsRepository->findAllComments();
            return header('Location: /commentadmin');
        }


        $error = 'L\'opération n\'a pas pu être effectuée.';
        return $this->twig->display('commentadmin.html.twig', [
            'error' => $error
        ]);
    }

}