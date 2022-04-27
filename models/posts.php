<?php

namespace Models;

class Posts
{
    public function getPost()
    {
        $database = new Database();
        $posts = $database->getPDO()->query('SELECT * FROM posts');

        return $posts;
    }
}