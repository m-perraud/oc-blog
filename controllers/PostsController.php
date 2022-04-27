<?php

namespace Controllers;
class PostsController extends Controller
{
    public function posts()
    {
        $this->twig->display('blog-grid.html.twig');
    }

    public function postDetails()
    {
        $this->twig->display('post-default.html.twig');
    }
}