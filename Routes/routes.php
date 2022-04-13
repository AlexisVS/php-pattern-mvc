<?php

namespace Routes;

use Controller\homeController;

/** @var Router $router */

$router->register('/', [homeController::class , "index"]);