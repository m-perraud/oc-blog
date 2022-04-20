<?php 

namespace Controllers; 

use Source\Renderer;

class ContactController
{
    public function contact(): Renderer
    {
        return Renderer::make('contact');
    }
}