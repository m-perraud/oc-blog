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

        if ($_SESSION['auth']) {
            return $this->twig->display('dashboard.html.twig', [
                'users' => $users
            ]);
            die();
        }

        header('Location: /Login');
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

    public function postsAdmin()
    {
        $postsRepository = new PostsRepository();
        $posts = $postsRepository->getAllPosts();

        if ($_SESSION['auth']) {
            return $this->twig->display('postsadmin.html.twig', [
                'posts' => $posts
            ]);
            die();
        }

        header('Location: /Login');
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

        if ($_SESSION['auth']) {
            return $this->twig->display('editpost.html.twig', [
                'posts' => $posts
            ]);
            die();
        }

        header('Location: /Login');
    }


    public function updatePost()
    {
    $postId = $_POST['postId'];
    $titlePost = trim($_POST['title']);
    $textPost = $_POST['text'];

    $targetDir = "..\Public\img\posts\\";
    $fileName = $_FILES['file']['name'];
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $postsRepository = new PostsRepository();


    if (isset($_POST['submit']) && isset($titlePost) && isset($textPost)) {


        $postsRepository->updatePost($titlePost, $textPost, $postId);



        $allowTypes = array('jpg','png','jpeg','gif','pdf');

        //dd($_FILES); 

        if (in_array($fileType, $allowTypes)) {

            move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath);

            $postsRepository->changeImagePost($postId, $fileName);
            
        }

        $posts= $postsRepository->getAllPosts();

        $success = 'L\'opération a bien pu être effectuée.';
        return header('Location: /postsadmin');
    }

    $error = 'L\'opération n\'a pas pu être effectuée. 
                Merci de vérifier que tous les champs sont remplis.';

    return $this->twig->display('editpost.html.twig', [
                'error' => $error
            ]);
}





        public function createPost()
        {
            $postsRepository = new PostsRepository();
    
            if ($_SESSION['auth']) {
                return $this->twig->display('createpost.html.twig');
                die();
            }
    
            header('Location: /Login');
        }

        public function newPost()
        {
            $titlePost = trim($_POST['title']);
            $textPost = $_POST['text'];
            $authorPost = $_POST['author'];
            $imagePost = $_FILES['file'];

            $targetDir = "..\Public\img\posts\\";
            $fileName = $_FILES['file']['name'];
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
    
            $postsRepository = new PostsRepository();


            if (isset($titlePost) &&  isset($textPost) && isset($authorPost) && isset($imagePost)) {

                $allowTypes = array('jpg','png','jpeg','gif','pdf');

                if (in_array($fileType, $allowTypes)) {
                    move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath);
                }

                $postsRepository->createPost($titlePost, $textPost, $authorPost, $fileName);
                $posts= $postsRepository->getAllPosts();
    
                    return header('Location: /postsadmin');
                }
    
                
                $error = 'L\'opération n\'a pas pu être effectuée. 
                Merci de vérifier que tous les champs sont remplis.';
    
                return $this->twig->display('createpost.html.twig', [
                    'error' => $error
                ]);
            }



    public function commentAdmin()
    {
        $commentsRepository = new CommentsRepository();
        $comments = $commentsRepository->findAllCommentsPending();

        if ($_SESSION['auth']) {
            return $this->twig->display('commentadmin.html.twig', [
                'comments' => $comments
            ]);
            die();
        }

        header('Location: /Login');
    }


    public function deleteComment()
    {
        $commentId = $_POST['commentId'];
        $deleteComment = $_POST['delete'];
        $validateComment = $_POST['validate'];

        $commentsRepository = new CommentsRepository();

        $comment = $commentsRepository->getOneComment($commentId);
        
        

        if (isset($deleteComment)) {
            $commentsRepository->deleteComment($commentId);
            $comments = $commentsRepository->findAllCommentsPending();
            return header('Location: /commentadmin');
        }

        if (isset($validateComment)) {
            $commentsRepository->validateComment($commentId);
            $comments = $commentsRepository->findAllCommentsPending();
            return header('Location: /commentadmin');
        }


        $error = 'L\'opération n\'a pas pu être effectuée.';
        return $this->twig->display('commentadmin.html.twig', [
            'error' => $error
        ]);
    }


    public function commentList()
    {
        $commentsRepository = new CommentsRepository();
        $comments = $commentsRepository->findAllCommentsValidated();

        if ($_SESSION['auth']) {
            return $this->twig->display('commentlist.html.twig', [
                'comments' => $comments
            ]);
            die();
        }

        header('Location: /Login');
    }

    public function deleteCommentList()
    {
        $commentId = $_POST['commentId'];
        $deleteComment = $_POST['delete'];
        $validateComment = $_POST['validate'];

        $commentsRepository = new CommentsRepository();

        $comment = $commentsRepository->getOneComment($commentId);
        
        

        if (isset($deleteComment)) {
            $commentsRepository->deleteComment($commentId);
            $comments = $commentsRepository->findAllCommentsPending();
            return header('Location: /commentlist');
        }

        $error = 'L\'opération n\'a pas pu être effectuée.';
        return $this->twig->display('commentlist.html.twig', [
            'error' => $error
        ]);
    }

}