<?php

namespace Controllers;

use Source\Renderer;

class PostsController
{
    public function posts(): Renderer
    {
        return Renderer::make('post-default');
    }
}