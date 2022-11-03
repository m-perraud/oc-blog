<?php

use Router\Router;
use Utils\Sanitize;


require '../vendor/autoload.php';


define('BASE_VIEW_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);

$sanitize = new Sanitize();
$url = $sanitize->cleanData($_GET['url']);
$router = new Router($url);


$router->get('/', "Home#index");
$router->get('/allposts', "Posts#grid");
$router->get('/posts/:id', "Posts#postDetails")->with('id', '[0-9]+');
$router->post('/createcomment', "Posts#newComment");
$router->get('/contact', "Contact#contact");
$router->get('/about', "Home#about");
$router->get('/login', "Home#login");
$router->post('/login', "Auth#loginForm");
$router->get('/logout', "Auth#logout");
$router->get('/register', "Home#register");
$router->post('/register', "Auth#registUser");
$router->get('/page404', "Home#page404");
$router->get('/page403', "Home#page403");
$router->get('/page500', "Home#page500");



$router->get('/dashboard', "Admin#dashAdmin");
$router->post('/dashboard', "Admin#userManagement");
$router->post('/changecred/:id', "Admin#userManagement")->with('id', '[0-9]+');

$router->get('/postsadmin', "Admin#postsAdmin");
$router->post('/deletepost/:id', "Admin#deletePost")->with('id', '[0-9]+');

$router->get('/editpost/:id', "Admin#editPost")->with('id', '[0-9]+');
$router->post('/updatepost', "Admin#updatePost");

$router->get('/commentadmin', "Admin#commentAdmin");
$router->post('/editcomment/:id', "Admin#editComment")->with('id', '[0-9]+');
$router->post('/deletecomment/:id', "Admin#deleteComment")->with('id', '[0-9]+');

$router->get('/commentlist', "Admin#commentList");
$router->post('/deletecommentlist/:id', "Admin#deleteCommentList")->with('id', '[0-9]+');

$router->get('/createpost', "Admin#createPost");
$router->post('/newpost', "Admin#newPost");

$router->post('/sendmail', "Contact#sendMail");

$router->run();

