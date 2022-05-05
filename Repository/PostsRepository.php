<?php

namespace Repository;

use PDO;
use Models\Database;
use Models\PostModel;

class PostsRepository extends Database
{
    public function findAllPost()
    {
        $sql = "SELECT * FROM posts";
        $result = $this->getPDO()->query($sql);
        //dd($result->fetchAll());
        $posts = $result->fetchAll(PDO::FETCH_CLASS, PostModel::class);
        return $posts;
    }
}