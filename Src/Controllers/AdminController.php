<?php

namespace Controllers;

use Repository\UserRepository;
use Repository\PostsRepository;
use Repository\CommentsRepository;
use Controllers\HomeController;

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
    $postId = $_POST['postId'];
    $titlePost = trim($_POST['title']);
    $textPost = $_POST['text'];
    $chapoPost = $_POST['chapo'];

    $targetDir = "..\Public\img\posts\\";
    $fileName = $_FILES['file']['name'];
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    $postsRepository = new PostsRepository();

    dd($_POST);

    if (isset($_POST['submit']) && isset($titlePost) && isset($textPost) && isset($chapoPost)) {

        $postsRepository->updatePost($titlePost, $textPost, $chapoPost, $postId);

        $allowTypes = array('jpg','png','jpeg','gif','pdf');

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
    
            if (!empty($_SESSION['auth'])) {
                return $this->twig->display('createpost.html.twig');
                die();
            }
            http_response_code(403);
            $this->twig->display('page403.html.twig');
        }




        public function newPost()
        {
            $titlePost = trim($_POST['title']);
            $textPost = $_POST['text'];
            $authorPost = $_POST['author'];
            $imagePost = $_FILES['file'];
            $chapoPost = $_POST['chapo'];


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
                }

                $postsRepository->createPost($titlePost, $textPost, $authorPost, $chapoPost, $newFileName);
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

        http_response_code(403);
        $this->twig->display('page403.html.twig');
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