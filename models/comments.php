<?php

namespace Models;

class Comments
{
    public function getComment()
    {
        $database = new Database();
        $comments = $database->getPDO()->query('SELECT * FROM comments');

        return $comments;
    }
}