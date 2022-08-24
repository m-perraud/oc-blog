<?php

namespace Controllers;

use Repository\CommentsRepository;
use Repository\PostsRepository;

class PostsController extends Controller
{
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

        $usernameComment = $_POST['username'];
        $textComment = $_POST['text'];
        $emailComment = $_POST['email'];
        $postId = $_POST['postId'];

        $commentsRepository = new CommentsRepository();
        $postsRepository = new PostsRepository();

        

        if ($_POST && isset($usernameComment) && isset($textComment) && isset($emailComment) && isset($postId)) {
        //dd($_POST);

            $comment = $commentsRepository->createComment($usernameComment, $textComment, $emailComment, $postId);


            $success = 'Votre commentaire a été envoyé aux administrateurs pour validation.';
            return $this->twig->display('post-default.html.twig', [
                'success' => $success
            ]);
        }

            $this->twig->display('index.html.twig');
    }


}