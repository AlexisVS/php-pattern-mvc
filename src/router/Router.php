<?php

namespace Source\router;

use Exception\RouterExecuteActionErrorException;

class Router
{
    /**
     * @var array routes
     */
    public $routes = [];

    /**
     * Register a route with a processed uri
     * @param string $uri
     * @param array|callable $action
     * @return void
     */
    public function register($uri, $action): void
    {
        $uri = explode('/', $uri);
        foreach ($uri as &$segment) {
            if (str_contains($segment, '{')) {
                $segment = '%d';
            }
        }
        $uri = implode('/', $uri);
        $this->routes[$uri] = $action;
    }

    /**
     * Resolve the request uri and return action result
     * @param string $uri
     * @return mixed
     */
    public function resolve(string $uri): mixed
    {
        // Take the params for the currrent request uri
        $params = $this->getRouteParameters($uri);

        // Resolve the current request uri
        $path = $this->resolvepath($uri);

        // get the action of the route
        $action = $this->routes[$path];

        // execute action
        return $this->executeAction($action, $params);
    }

    // /**
    //  * Register action into routes
    //  * @param string $uri
    //  */
    // public function

    /**
     * Get the parameters of the current route URI
     * @param string $uri
     * @return array
     */
    public function getRouteParameters($uri): array
    {
        $parameters = [];
        $route = explode('/', $uri);
        foreach ($route as $segment) {
            if (preg_match("/^(0|[1-9][0-9]*)$/", $segment)) {
                $parameters[] = $segment;
            }
        }
        return $parameters;
    }

    /**
     * Resolve path of the current uri
     * @param string $uri
     * @return string $uri
     */
    public function resolvePath(string $uri): string
    {
        $uri = explode('/', $uri);
        foreach ($uri as &$segment) {
            if (preg_match("/^(0|[1-9][0-9]*)$/", $segment)) {
                $segment = '%d';
            }
        }
        $uri = implode('/', $uri);
        return $uri;
    }

    /**
     * Execute action stocked in $this->routes
     * @param array|callable $action
     * @param array $params
     * @return mixed
     */
    public function executeAction(array|callable $action, array $params = []): mixed
    {
        try {
            if (is_callable($action)) {
                return call_user_func($action, ...$params);
            }
            if (is_array($action)) {
                $class = new $action[0];
                return call_user_func_array([$class, $action[1]], ...$params);
            }
        } catch (RouterExecuteActionErrorException $e) {
            echo $e->getMessage();
        }
    }
}