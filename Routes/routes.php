<?php

namespace Routes;

use Controller\homeController;
use Source\Helper;
use Source\router\Router;

/** @var Router $router */

// $router->register('/', [homeController::class , "index"]);
$router->register('/qsd/user/{userId}/qsd/hotel/{hotelId}/balec', function ($userid, $hotelId) {
  return "<h1 style=" . "color:red;" . ">hi userid: $userid and your hotel id is $hotelId </h1>";
});