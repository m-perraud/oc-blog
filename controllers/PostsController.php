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

        //dd($posts);
        return $this->twig->display('post-default.html.twig', [
            'posts' => $posts,
            'comments' => $comments,
            'lastPosts' => $lastPosts
        ]);
    }

}