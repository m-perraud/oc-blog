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
