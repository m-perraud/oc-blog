<?php


namespace Router;

use Exceptions\RouteNotFoundException;

//use Router\Route;


class Router
{
    private $url;
    private $routes = [];
    private $namedRoutes = [];


    public function __construct($url)
    {
        $this->url = $url;
    }


    public function get(string $path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'GET');
    }


    public function post(string $path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    private function add($path, $callable, $name, $method)
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if($name)
        {
            $this->namedRoutes[$name] = $route;
        }
        if(is_string($callable) && $name === null)
        {
            $name = $callable;
        }
        return $route;
    }

    public function run()
    {
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            throw new RouteNotFoundException();
        }
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }
        throw new RouteNotFoundException();
    }

    public function url($name, $params = [])
    {
        if(!isset($this->namedRoutes[$name]))
        {
            throw new RouteNotFoundException();
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }
}






    /*
        public $url;
        public $routes = [];

        public function __construct($url)
        {
            $this->url = trim($url, '/');
        }


        public function get(string $path, string $action)
        {
            $this->routes['GET'][] = new Route($path, $action);
        }

        public function run()
        {
            foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route)
            {
                if ($route->matches($this->url))
                {
                    $route->execute();
                }
            }

            return header('HTTP/1.0 404 Not Found');
        }
    */



/*
    private array $routes;

    public function register(string $path, callable|array $action, int $id = null): void
    {
        $this->routes[$path] = $action;
    }

    public function resolve(string $uri): mixed
    {
        dump($uri);
        $path = explode('?', $uri)[0];
        $specific = explode('/', $uri);
        if ($specific[1] === 'article') {
            $path = $specific[1] . '/:' . $specific[2];
            dump($path);
        }
        $action = $this->routes[$path] ?? null;

        if (is_callable($action)) {
            return $action();
        }

        if (is_array($action)) {
            [$className, $method] = $action;

            if (class_exists($className) && method_exists($className, $method)) {
                $class = new $className();
                return call_user_func_array([$class, $method], []);
            }
        }
        
        throw new RouteNotFoundException();
    }
    */
