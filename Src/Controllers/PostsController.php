<?php

namespace Controllers;

use Repository\CommentsRepository;
use Repository\PostsRepository;
use Utils\Pagination;

class PostsController extends Controller
{

    public function grid()
    {
        
        $pagination = new Pagination(); 
        $pages = $pagination->nmbrPages();
        $posts = $pagination->getData();

        return $this->twig->display('blog-grid.html.twig', [
            'posts' => $posts,
            'pages' => $pages
        ]);
    }


    public function postDetails($id)
    {
        $postsRepository = new PostsRepository(); 
        $commentsRepository = new CommentsRepository();

        $posts = $postsRepository->getOnePost($id);
        $comments = $commentsRepository->getAllComments($id);
        $lastPosts = $postsRepository->getLastPosts();

        return $this->twig->display('post-default.html.twig', [
            'posts' => $posts,
            'comments' => $comments,
            'lastPosts' => $lastPosts
        ]);
    }


    public function newComment()
    {

        $usernameComment = $this->sanitize->cleanData($_POST['username']);
        $textComment = $this->sanitize->cleanData($_POST['text']);
        $emailComment = $this->sanitize->cleanData($_POST['email']);
        $postId = $this->sanitize->cleanData($_POST['postId']);

        $commentsRepository = new CommentsRepository();
        $postsRepository = new PostsRepository();

        if ($_POST && isset($usernameComment) && isset($textComment) && isset($emailComment) && isset($postId)) 
        {

            $comment = $commentsRepository->createComment($usernameComment, $textComment, $emailComment, $postId);

            $posts = $postsRepository->getOnePost($postId);
            $comments = $commentsRepository->getAllComments($postId);
            $lastPosts = $postsRepository->getLastPosts();

            $success = 'Votre commentaire a été envoyé aux administrateurs pour validation.';
            return $this->twig->display('post-default.html.twig', [
                'success' => $success, 
                'posts' => $posts,
                'comments' => $comments,
                'lastPosts' => $lastPosts
            ]);
        }

            $this->twig->display('index.html.twig');
    }


}