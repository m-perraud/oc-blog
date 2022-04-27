<?php

namespace Controllers; 

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    private $loader;
    protected $twig;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(dirname(__DIR__) .'/'.'views'.'/templates');

        $this->twig = new Environment($this->loader);
    }
}