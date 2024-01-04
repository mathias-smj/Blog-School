<?php

namespace app;

use Exception;

class Router
{
    /**
     * An array to store the defined routes.
     *
     * @var array
     */
    protected array $routes = [];

    /**
     * Add a new route to the router.
     *
     * @param string $route      The route path.
     * @param string $controller The controller associated with the route.
     * @param string $action     The controller action to execute for the route.
     * @return void
     */
    public function addRoute($route, $controller, $action): void
    {
        $this->routes[$route] = ['controller' => $controller, 'action' => $action];
    }

    /**
     * Extracts the left part of a string before a specified character.
     *
     * @param string $str  The input string.
     * @param string $char The character to search for.
     * @return string      The left part of the string before the character.
     */
    function strLeftOf($str, $char): string
    {
        return substr($str, 0, strpos($str, $char));
    }

    /**
     * Dispatches a request to the appropriate controller and action based on the URI.
     *
     * @param string $originalUri The original URI from the request.
     * @throws Exception          Throws an exception if no route is found for the URI.
     * @return void
     */
    public function dispatch($originalUri): void
    {
        $uri = $originalUri;
        if (strPos($originalUri, "?") > 0) {
            $uri = $this->strLeftOf($originalUri, "?");
        }
        if (array_key_exists($uri, $this->routes)) {
            $controller = $this->routes[$uri]['controller'];
            $action = $this->routes[$uri]['action'];
            $controller = new $controller();
            $controller->$action();
        } else {
            throw new Exception("No route found for URI: $uri");
        }
    }
}
