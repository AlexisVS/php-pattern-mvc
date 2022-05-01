<?php

namespace Tests\router;

use PHPUnit\Framework\TestCase;
use Source\router\Router;
use Controller\homeController;
use Source\Helper;
use Source\Request;
use Tests\entities\TestController;

class RouterTest extends TestCase
{
  public $router;

  public function setUp(): void
  {
    $this->router = new Router();
  }

  /** @covers */
  public function testCheckIfRouterHasBeenCorrectlyCreated(): void
  {
    $this->assertInstanceOf(Router::class , $this->router, "Router class not created correctly");
  }

  /** @covers */
  public function testCheckIfRouteActionHasBeenRegistered(): void
  {
    $this->router->register('/testing', function () {
      return "testPassed";
    });
    $this->assertArrayHasKey('/testing', $this->router->routes, "Dont find testing route");
  }

  /** @covers */
  public function testCheckIfRouteControllerHasBeenRegistered(): void
  {
    $this->router->register('/testController', [homeController::class , "index"]);
    $this->assertArrayHasKey('/testController', $this->router->routes, "Dont find key");
  }

  /** @covers */
  public function testCheckIfRouterResolveRoute(): void
  {
    $this->router->register('/testController', [homeController::class , "index"]);
    $request = new Request("/testController");
    $this->assertNotNull($this->router->resolve($request->uri));
  }

  /** @covers */
  public function testCanGetParamsToRouteActionWithParams(): void
  {
    $this->router->register("/test/user/{userId}/test1/test-model/{testModelId}", function ($userId, $testModelId) {
      return "Hi i'm user Id: " . $userId . "and here is my testModelId:" . $testModelId;
    });
    $request = new Request("/test/user/123/test1/test-model/321");
    $resolve = $this->router->resolve($request->uri);
    $this->assertNotNull($resolve, "The uri params test has encountered an error");
  }

  /** @covers */
  public function testCanGetParamsToRouteControllerWithParams(): void
  {
    $request = new Request("/test/user/123/test1/test-model/321");
    $controller = new TestController;
    $this->router->register("/test/user/{userId}/test1/test-model/{testModelId}", [$controller, "show"]);
    $resolve = $this->router->resolve($request->uri);
    $this->assertNotNull($resolve, "The uri params test has encountered an error");
  }
}
