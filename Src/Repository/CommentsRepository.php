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
        $comments = $result->fetchAll(PDO::FETCH_CLASS, CommentModel::class);
        return $comments;
    }

    public function findAllCommentsPending()
    {
        $sql = "SELECT * FROM comments WHERE commentStatus = 0";
        $result = $this->getPDO()->query($sql);
        $comments = $result->fetchAll(PDO::FETCH_CLASS, CommentModel::class);
        return $comments;
    }

    public function getOneComment($commentId)
    {
        $sql = "SELECT * FROM comments WHERE ID = $commentId";
        $result = $this->getPDO()->query($sql);
        $comments = $result->fetchObject(CommentModel::class);
        //$comments = $result->fetchAll(PDO::FETCH_CLASS, CommentModel::class);
        return $comments;
    }

    public function deleteComment($commentId)
    {
        $sql = "DELETE FROM comments WHERE id = $commentId";
        $result = $this->getPDO()->query($sql);
        $comments = $result->fetchAll(PDO::FETCH_CLASS, CommentModel::class);
        return $comments;
    }

    public function findAllCommentsValidated()
    {
        $sql = "SELECT * FROM comments WHERE commentStatus = 1";
        $result = $this->getPDO()->query($sql);
        $comments = $result->fetchAll(PDO::FETCH_CLASS, CommentModel::class);
        return $comments;
    }

    public function validateComment($commentId)
    {
        $sql = "UPDATE comments SET commentStatus = 1 WHERE id = $commentId";
        $result = $this->getPDO()->query($sql);
        $comments = $result->fetchAll(PDO::FETCH_CLASS, CommentModel::class);
        return $comments;
    }


    public function createComment($usernameComment, $textComment, $emailComment, $postId)
    {
        $sql = "INSERT INTO `comments` 
        (`commentUsername`, `commentText`, `commentMail`, `postId`)
        VALUES 
        (\"$usernameComment\", \"$textComment\", \"$emailComment\", \"$postId\")";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, CommentModel::class);
        return $posts;
    }

}