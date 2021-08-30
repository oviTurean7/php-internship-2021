<?php

namespace App\Core;

use App\Exceptions\RouteException;

class Router
{
    protected $routes;
    protected $parameters;

    public function __construct()
    {
        $this->routes = [];
        $this->parameters = [];
    }

    public function __call($method, $args)
    {
        if (count($args) != 2) {
            throw new RouteException('Invalid route definition');

        }

        $this->routes[] = ['method' => $method, 'name' => $args[0], 'action' => $args[1]];

        //this will allow us to chain method calls
        return $this;
    }

    public function getRouteAction($uri, $method)
    {
        //the passed method is with uppercase GET and we define routes with lowercase
        $route = $this->findMatchingRoute($uri, strtolower($method));

        return $route;
    }

    public function filter($filterName)
    {
        end($this->routes);

        $position = key($this->routes);
        $route = current($this->routes);
        $route['filters'] = is_array($filterName) ? $filterName : [$filterName];
        $this->routes[$position] = $route;

        reset($this->routes);
    }

    protected function findMatchingRoute($uri, $method)
    {
        //used to avoid any possible encoded characters from urlencode
        $path = rawurldecode($uri);
        //if it's a get request, we will have the input appended
        $path = (strpos($path, '?') !== false) ? strstr($path, '?', true) : $path;
        $path = trim($path, '/');

        if ($path === '') {
            //this matches the /
            foreach ($this->routes as $route) {
                if ($route['name'] === '/' && $route['method'] === $method) {
                    return $route;
                }
            }

            throw new RouteException('Route / is not defined');


        }

        foreach ($this->routes as $route) {
            if ($this->checkRouteMatch($path, $method, $route)) {
                if (count($this->parameters)) {
                    $route['parameters'] = $this->parameters;
                }

                return $route;
            }
        }


        throw new RouteException('Invalid route, or has another http verb');
    }

    protected function checkRouteMatch($path, $method, $route)
    {

        if ($method !== $route['method']) {
            return false;
        }

        $routeParts = explode('/', $path);
        $targetRoute = trim($route['name'], '/');

        $targetRoute2 = (strpos($targetRoute, '?') !== false) ? strstr($targetRoute, '?', true) : $path;

        $comparingRouteParts = explode('/', $targetRoute);

        if (count($routeParts) !== count($comparingRouteParts)) {
        return false;
        }

        if (count(array_intersect($routeParts, explode('/', $targetRoute2))) == count($routeParts)){
            for ($index = 0; $index < count($routeParts); $index++) {
                $routePart = $routeParts[$index];
                $comparingRoutePart = $comparingRouteParts[$index];

                $openBrace = strpos($comparingRoutePart, '{');
                $closeBrace = strpos($comparingRoutePart, '}');
                if ($openBrace !== false && $closeBrace !== false && $openBrace < $closeBrace) {
                    //if the compared route contains {something} this matches anything

                    $this->parameters[] = $routePart;
                    continue;
                }

                //any of them is present but not both or in the wrong order
                if ($openBrace || $closeBrace) {
                    return false;
                }

                if ($routePart !== $comparingRoutePart) {
                    return false;
                }
            }
        }
        else {
            return false;
        }



        return true;
    }
}
