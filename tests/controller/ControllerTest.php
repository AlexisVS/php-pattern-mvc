<?php

namespace Tests\controller;
use PHPUnit\Framework\TestCase;
use Tests\entities\TestController;

class ControllerTest extends TestCase
{

  /** @var  TestController*/
  public $_instance;

  public function setUp(): void
  {
    $this->_instance = new TestController;
  }

  /** @covers */
  public function testCheckIfInstanceHasBeenCorrectlyCreated(): void
  {
    $this->assertInstanceOf(TestController::class , $this->_instance, "Router class not created correctly");
  }

  /** @covers */
  public function testCheckShowMethodAsBeenCorrectlyExecuted(): void
  {
    $userId = 2;
    $testModelId = 5;
    $this->assertEquals("Hi i'm user Id: " . $userId . "and here is my testModelId:" . $testModelId, $this->_instance->show($userId, $testModelId));
  }
}