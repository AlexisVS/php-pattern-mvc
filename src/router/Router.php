<?php

namespace Source\router;

use Exception\RouterRouteNotFoundException;

class Router
{ /**
  * @var array routes
  */
  public $routes = [];

  /**
   * Register a route
   * @param string $uri
   * @param array|callable $action
   * @return void
   */
  public function register($uri, $action, $args = []): void
  {
    if (is_callable($action)) {
      $this->routes[$uri] = $action;
    }
    if (is_array($action)) {
      $class = new $action[0];
      $action = call_user_func_array([$class, $action[1]], $args);
      $this->routes[$uri] = $action;
    }
  }

  /**
   * Resolve the request uri and return action result
   * @param string $uri
   * @return mixed
   */
  public function resolve($uri): mixed
  {
    try {
      return $this->routes[$uri];
    }
    catch (RouterRouteNotFoundException $e) {
      echo $e->getMessage;
    }
  }
}