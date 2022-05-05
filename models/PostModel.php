<?php

namespace Models;

class CommentModel
{
    private string $idPost;
    private string $postTitle;
    private string $postText;
    private string $postDate;
    private string $adminId;

    /*public function __construct(string $id, string $userMail, string $userStatus)
    {
        $this->id = $id;
        $this->userMail = $userMail;
        $this->userStatus = $userStatus;
    } */

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

    public function setPostTitle(string $postTitle): void
    {
        $this->postTitle = $postTitle;
    }

    public function setPostText(string $postText): void
    {
        $this->postText = $postText;
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
