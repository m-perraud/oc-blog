<?php

namespace Repository;

use PDO;
use Models\Database;
use Models\PostModel;

class PostsRepository extends Database
{
    public function getLastPosts()
    {
        $sql = "SELECT postTitle, postDate FROM posts ORDER BY ID desc LIMIT 4";
        $result = $this->getPDO()->query($sql);
        //dd($result->fetchAll());
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

    public function getAllPosts()
    {
        $sql = "SELECT * FROM posts";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }





    public function countAllPosts()
    {
        $sql = "SELECT count(id) AS nbrLignes FROM posts";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetch();
        $totalPosts = (int) $posts['nbrLignes'];
        return $totalPosts;
    }






    public function getOnePost($id)
    {
        $sql = "SELECT * FROM posts WHERE ID = $id ORDER BY 'postDate' DESC";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

    
    public function createPost($titlePost, $textPost, $authorPost, $fileName)
    {
        $sql = "INSERT INTO `posts` 
        (`postTitle`, `postText`, `postAuthor`, `postImage`)
        VALUES 
        (\"$titlePost\", \"$textPost\", \"$authorPost\", \"$fileName\")";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

    public function updatePost($titlePost, $textPost, $postId)
    {
        $sql = "UPDATE posts SET postTitle = \"$titlePost\", postText = \"$textPost\" WHERE id = \"$postId\"";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }


    public function deletePost($postId)
    {
        $sql = "DELETE FROM posts WHERE ID = $postId";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }


    public function changeImagePost($postId, $fileName)
    {
        
        $sql = "UPDATE posts SET postImage = \"$fileName\" WHERE id = \"$postId\"";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

    public function addImagePost($postId, $fileName)
    {
        
        $sql = "INSERT into posts (postImage) WHERE id = $postId VALUES (\"$fileName\")";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

}