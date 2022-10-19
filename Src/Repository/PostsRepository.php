<?php

namespace Repository;

use PDO;
use Models\Database;
use Models\PostModel;

class PostsRepository extends Database
{
    public function getLastPosts()
    {
        $sql = "SELECT postTitle, postDate, postChapo FROM posts ORDER BY ID desc LIMIT 4";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

    public function getAllPosts()
    {
        $sql = "SELECT posts.*,user.adminLogin AS adminLogin FROM posts INNER JOIN user ON posts.postAuthor = user.id ORDER BY posts.id DESC";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

    public function countAllPosts()
    {
        $sql = "SELECT count(id) AS nbrLignes FROM posts";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetch(PDO::FETCH_ASSOC);
        $totalPosts = $posts['nbrLignes'];
        return $totalPosts;
    }

    public function postsPerPage($start, $limit)
    {
        $sql = "SELECT posts.*,user.adminLogin AS adminLogin FROM posts INNER JOIN user ON posts.postAuthor = user.id ORDER BY posts.id DESC LIMIT $start, $limit";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

    public function getOnePost($id)
    {
        $sql = "SELECT * FROM posts INNER JOIN user ON posts.postAuthor = user.id WHERE posts.id = $id ORDER BY postDate DESC";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

    
    public function createPost($titlePost, $textPost, $authorPost, $chapoPost, $newFileName)
    {
        $sql = "INSERT INTO `posts` 
        (`postTitle`, `postText`, `postAuthor`, `postChapo`, `postImage`)
        VALUES 
        (\"$titlePost\", \"$textPost\", \"$authorPost\", \"$chapoPost\", \"$newFileName\")";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

    public function updatePost($titlePost, $textPost,$chapoPost, $postId)
    {
        $sql = "UPDATE posts SET postTitle = \"$titlePost\", postText = \"$textPost\", postChapo = \"$chapoPost\"  WHERE id = \"$postId\"";
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