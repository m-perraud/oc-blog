<?php

use Source\App;
use Router\Router;


require '../vendor/autoload.php';

define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);

$router = new Router();

$router->register('/', ['Controllers\HomeController', 'index']);
$router->register('/contact', ['Controllers\ContactController', 'contact']);
$router->register('/posts', ['Controllers\PostsController', 'posts']);
$router->register('/article', ['Controllers\PostsController', 'postDetails']);
$router->register('/about', ['Controllers\HomeController', 'about']);
$router->register('/login', ['Controllers\HomeController', 'login']);
$router->register('/register', ['Controllers\HomeController', 'register']);
$router->register('/page404', ['Controllers\HomeController', 'page404']);

(new App($router, $_SERVER['REQUEST_URI']))->run();

