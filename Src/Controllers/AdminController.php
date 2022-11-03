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

        if (!empty($_SESSION['auth'])) {
            return $this->twig->display('dashboard.html.twig', [
                'users' => $users
            ]);
            die();
        }
        http_response_code(403);
        header('Location: /page403');
    }

    public function userManagement($adminId)
    {
        $adminId = $this->sanitize->cleanData($_POST['adminId']);
        $deleteAdmin = $this->sanitize->cleanData($_POST['delete']);

        $userRepository = new UserRepository();


        if (isset($deleteAdmin)) {
            $userRepository->updateAdmin($adminId);

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

        if (!empty($_SESSION['auth'])) {
            return $this->twig->display('postsadmin.html.twig', [
                'posts' => $posts
            ]);
            die();
        }

        http_response_code(403);
        header('Location: /page403');
    }

    public function deletePost()
    {
        $postId = $this->sanitize->cleanData($_POST['postId']);
        $deletePost = $this->sanitize->cleanData($_POST['delete']);

        $postsRepository = new PostsRepository();


        if (isset($deletePost)) {
            $postsRepository->deletePost($postId);
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

        if (!empty($_SESSION['auth'])) {
            return $this->twig->display('editpost.html.twig', [
                'posts' => $posts
            ]);
            die();
        }

        http_response_code(403);
        header('Location: /page403');
    }


    public function updatePost()
    {
    $postId = $this->sanitize->cleanData($_POST['postId']);
    $titlePost = $this->sanitize->cleanData(trim($_POST['title']));
    $textPost = $this->sanitize->cleanData($_POST['text']);
    $chapoPost = $this->sanitize->cleanData($_POST['chapo']);
    $submit = $this->sanitize->cleanData($_POST['submit']);


    $targetDir = "..\Public\img\posts\\";
    $fileName = $_FILES['file']['name'];
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $postsRepository = new PostsRepository();
    $posts = $postsRepository->getOnePost($postId);

    if (isset($submit) && isset($titlePost) && isset($textPost) && isset($chapoPost)) {
    

        $allowTypes = array('jpg','png','jpeg','gif','pdf');

        if (in_array($fileType, $allowTypes)) {
            
            $postsRepository->updatePost($titlePost, $textPost, $chapoPost, $postId);

            move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath);
            $postsRepository->changeImagePost($postId, $fileName);

            return header('Location: /postsadmin');
        }
        
    }

        $error = 'L\'opération n\'a pas pu être effectuée. 
        Merci de vérifier que tous les champs sont remplis et les fichiers dans le bon format..';

        return $this->twig->display('editpost.html.twig', [
            'posts' => $posts, 
            'error' => $error
        ]);
    
}

        public function createPost()
        {

    
            if (!empty($_SESSION['auth'])) {
                return $this->twig->display('createpost.html.twig');
                die();
            }
            http_response_code(403);
            $this->twig->display('page403.html.twig');
        }

        public function newPost()
        {
            $titlePost = $this->sanitize->cleanData(trim($_POST['title']));
            $textPost = $this->sanitize->cleanData($_POST['text']);
            $authorPost = $this->sanitize->cleanData($_POST['author']);
            $imagePost = $_FILES['file'];
            $chapoPost = $this->sanitize->cleanData($_POST['chapo']);


            $targetDir = "..\Public\img\posts\\";
            $temp = explode(".", $_FILES["file"]["name"]);
            $newFileName = round(microtime(true)) . '.' . end($temp);
            $targetFilePath = $targetDir . $newFileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            $postsRepository = new PostsRepository();

            if (isset($titlePost) &&  isset($textPost) && isset($authorPost) && isset($chapoPost) && isset($imagePost)) {

                $allowTypes = array('jpg','png','jpeg','gif','pdf');
                if (in_array($fileType, $allowTypes)) {
                    move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath);

                    $postsRepository->createPost($titlePost, $textPost, $authorPost, $chapoPost, $newFileName);

                    return header('Location: /postsadmin');

                } 
                }

                $error = 'L\'opération n\'a pas pu être effectuée. 
                Merci de vérifier que tous les champs sont remplis et les fichiers dans le bon format.';

                return $this->twig->display('createpost.html.twig', [
                    'error' => $error
                ]);
            }



    public function commentAdmin()
    {
        $commentsRepository = new CommentsRepository();
        $comments = $commentsRepository->findAllCommentsPending();

        if (!empty($_SESSION['auth'])) {
            return $this->twig->display('commentadmin.html.twig', [
                'comments' => $comments
            ]);
            die();
        }

        http_response_code(403);
        $this->twig->display('page403.html.twig');
    }


    public function deleteComment()
    {
        $commentId = $this->sanitize->cleanData($_POST['commentId']);
        $deleteComment = $_POST['delete'];
        $validateComment = $this->sanitize->cleanData($_POST['validate']);

        $commentsRepository = new CommentsRepository();

        $comment = $commentsRepository->getOneComment($commentId);
        
        

        if (isset($deleteComment)) {
            $commentsRepository->deleteComment($commentId);
            return header('Location: /commentadmin');
        }

        if (isset($validateComment)) {
            $commentsRepository->validateComment($commentId);
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

        http_response_code(403);
        $this->twig->display('page403.html.twig');
    }

    public function deleteCommentList()
    {
        $commentId = $this->sanitize->cleanData($_POST['commentId']);
        $deleteComment = $this->sanitize->cleanData($_POST['delete']);

        $commentsRepository = new CommentsRepository();

        if (isset($deleteComment)) {
            $commentsRepository->deleteComment($commentId);
            return header('Location: /commentlist');
        }

        $error = 'L\'opération n\'a pas pu être effectuée.';
        return $this->twig->display('commentlist.html.twig', [
            'error' => $error
        ]);
    }

}