<?php

namespace Repository;

use PDO;
use Models\Database;
use Models\CommentModel;

class CommentsRepository extends Database
{
    public function getAllComments($id)
    {
        $sql = "SELECT * FROM comments WHERE postId = $id";
        $result = $this->getPDO()->query($sql);
        //dd($result->fetchAll());
        $comments = $result->fetchAll(PDO::FETCH_CLASS, CommentModel::class);
        return $comments;
    }

    public function findAllComments()
    {
        $sql = "SELECT * FROM comments WHERE commentStatus = 0";
        $result = $this->getPDO()->query($sql);
        //dd($result->fetchAll());
        $comments = $result->fetchAll(PDO::FETCH_CLASS, CommentModel::class);
        return $comments;
    }

    public function getOneComment($id)
    {
        $sql = "SELECT * FROM comments WHERE ID = $id";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

    public function deleteComment($commentId)
    {
        $sql = "DELETE FROM posts WHERE id = $commentId";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }


}