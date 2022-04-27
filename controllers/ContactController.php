<?php 

namespace Controllers; 
class ContactController extends Controller
{
    public function contact()
    {
        $this->twig->display('contact.html.twig');
    }
}