<?php

use Repository\PostsRepository;


class Pagination {

    private $limit = 10;


    public function set_total_records(){

        $postsRepository = new PostsRepository();
        $totalPosts = $postsRepository->countAllPosts();

        }


    public function current_page(){
        return isset($_GET['page']) ? (int)$_GET['page'] :1;
    }


    public function get_data() {
        $start = 0;

        if($this->current_page() > 1) {
            $start = ($this->current_page() * $this->limit) - $this->limit;
        }
    }

        
    }
