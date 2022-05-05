<?php

namespace Repository;

use PDO;
use Models\Database;
use Models\CommentModel;

class CommentsRepository extends Database
{
    public function findAllComments()
    {
        $sql = "SELECT * FROM comments";
        $result = $this->getPDO()->query($sql);
        //dd($result->fetchAll());
        $comments = $result->fetchAll(PDO::FETCH_CLASS, CommentModel::class);
        return $comments;
    }
}