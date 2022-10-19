<?php

namespace Utils;

use Repository\PostsRepository;


class Pagination {

    public $limit = 6;
    public $start = 0;

    private function nmbrTotalPosts()
    {
        $postsRepository = new PostsRepository();
        $totalPosts = $postsRepository->countAllPosts();

        return $totalPosts;
        }

    public function nmbrPages(){
        $nmbrPages = ceil($this->nmbrTotalPosts()/ $this->limit);

        return $nmbrPages;
    }

    public function current_page(){
        return isset($_GET['page']) ? (int)$_GET['page'] :1;
    }

    public function getData($start) {

        $postsRepository = new PostsRepository();

        if($this->current_page() > 1) {
            $start = ($this->current_page() * $this->limit) - $this->limit;
        }

        $pagePosts = $postsRepository->postsPerPage($start, $this->limit);

        return $pagePosts;

    }
    
    }
