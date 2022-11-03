<?php

namespace Controllers; 

use Twig\Environment;
use Repository\UserRepository;
use Twig\Loader\FilesystemLoader;
use Utils\Sanitize;

class Controller
{
    private $loader;
    protected $twig;
    public $sanitize;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE){
            session_start(['cookie_lifetime' => 86400]);
        }

        $this->loader = new FilesystemLoader(dirname(__DIR__) .'/'.'views'.'/templates');

        $this->twig = new Environment($this->loader);
        $this->twig->addGlobal('session', $_SESSION);

        $this->sanitize = new Sanitize();

    }


}