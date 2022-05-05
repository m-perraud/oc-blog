<?php

namespace Models;

class CommentModel
{
    private string $idComment;
    private string $commentUsername;
    private string $commentMail;
    private string $commentText;
    private string $commentDate;
    private string $postId;


    /*public function __construct(string $id, string $userMail, string $userStatus)
    {
        $this->id = $id;
        $this->userMail = $userMail;
        $this->userStatus = $userStatus;
    } */

    public function getIdComment(): string
    {
        return $this->idComment;
    }

    public function getCommentUsername(): string 
    {
        return $this->commentUsername;
    }

    public function getCommentMail(): string
    {
        return $this->commentMail;
    }

    public function getCommentText(): string
    {
        return $this->commentText;
    }

    public function getCommentDate(): string
    {
        return $this->commentDate;
    }

    public function getPostId(): string
    {
        return $this->postId;
    }

    public function setIdComment(string $idComment): void
    {
        $this->idComment = $idComment;
    }

    public function setCommentUsername(string $commentUsername): void
    {
        $this->commentUsername = $commentUsername;
    }

    public function setCommentMail(string $commentMail): void
    {
        $this->commentMail = $commentMail;
    }

    public function setCommentText(string $commentText): void
    {
        $this->commentText = $commentText;
    }

    public function setCommentDate(string $commentDate): void
    {
        $this->commentDate = $commentDate;
    }

    public function setPostId(string $postId): void
    {
        $this->postId = $postId;
    }
}

