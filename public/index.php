<?php

//use Source\App;
use Router\Router;


require '../vendor/autoload.php';


define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);

$router = new Router($_GET['url']);

//$router->get('/', function(){ echo 'Je suis la Homepage'; });
$router->get('/home', "Home#index");
$router->get('/posts/:id-:slug', "Posts#postDetails")->with('id', '[0-9]+')->with('slug', '([a-z\-0-9]+)');
$router->get('/contact', "Contact#contact");
$router->get('/about', "Home#about");
$router->get('/login', "Home#login");
$router->get('/register', "Home#register");
$router->get('/page404', "Home#page404");

$router->run();

//$router->post('/posts/:id', "Posts#show");












/*



$router->register('/', ['Controllers\HomeController', 'index']);
$router->register('/contact', ['Controllers\ContactController', 'contact']);
$router->register('/posts', ['Controllers\PostsController', 'posts']);
$router->register('/article', ['Controllers\PostsController', 'postDetails']);
$router->register('/about', ['Controllers\HomeController', 'about']);
$router->register('/login', ['Controllers\HomeController', 'login']);
$router->register('/register', ['Controllers\HomeController', 'register']);
$router->register('/page404', ['Controllers\HomeController', 'page404']);

(new App($router, $_SERVER['REQUEST_URI']))->run();
*/