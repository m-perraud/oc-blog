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

        $sql = "SELECT * FROM posts ";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

    public function getOnePost($id)
    {
        $sql = "SELECT * FROM posts WHERE ID = $id ORDER BY 'postDate' DESC";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

    
    public function createPost($title, $text, $author, $image)
    {
        $sql = "INSERT INTO posts ('postTitle', 'postText', 'postAuthor', 'postImage')
        VALUES (\"$title\", \"$text\", \"$author\", \"$image\")";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

    public function updatePost(PostModel $post)
    {
        $sql = "UPDATE posts SET 'postTitle'=\"$post->getPostTitle()\", 'postText'=\"$newText\", 'postAuthor'=\"$newAuthor\", 'postImage'=\"$newImage\"";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

    public function deletePost($id)
    {
        $sql = "DELETE FROM posts WHERE ID = $id";
        $result = $this->getPDO()->query($sql);
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }

}