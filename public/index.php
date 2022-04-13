<?php

// autoload

use Source\Helper;
use Source\router\Router;

require '../vendor/autoload.php';


$router = new Router();

// Routes
include '../Routes/routes.php';
echo "<hr/>";

Helper::beautifful_print([$router->routes,]);

Helper::beautifful_print($router->resolve('/qsd/user/352/qsd/hotel/5454/balec'));