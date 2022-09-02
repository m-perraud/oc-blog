<?php

namespace Models;

class PostModel
{
    private string $idPost;
    private string $postTitle;
    private string $postText;
    private string $postDate;
    private string $adminId;

    public function getIdPost(): string
    {
        return $this->idPost;
    }

    public function getPostTitle(): string 
    {
        return $this->postTitle;
    }

    public function getPostText(): string
    {
        return $this->postText;
    }

    public function getPostDate(): string
    {
        return $this->postDate;
    }

    public function getAdminId(): string
    {
        return $this->adminId;
    }

    public function setIdPost(string $idPost): void
    {
        $this->idPost = $idPost;
    }

    public function setPostTitle(string $postTitle): PostModel
    {
        $this->postTitle = $postTitle;
        return $this;
    }

    public function setPostText(string $postText): PostModel
    {
        $this->postText = $postText;
        return $this;
    }

    public function setPostDate(string $postDate): void
    {
        $this->postDate = $postDate;
    }

    public function setAdminId(string $adminId): void
    {
        $this->adminId = $adminId;
    }

}
