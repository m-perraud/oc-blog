<?php 

namespace Controllers; 

use Repository\PostsRepository;

class ContactController extends Controller
{
    public function contact()
    {
        $postsRepository = new PostsRepository(); 
        $posts = $postsRepository->getLastPosts();
        return $this->twig->display('contact.html.twig', [
            'posts' => $posts
        ]);
    }
}