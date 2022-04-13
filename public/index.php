<?php

// autoload

use Source\Helper;
use Source\router\Router;

require '../vendor/autoload.php';


$router = new Router();

// Routes
include '../Routes/routes.php';

Helper::beautifful_print($router->routes);