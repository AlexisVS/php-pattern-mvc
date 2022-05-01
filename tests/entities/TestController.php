<?php

namespace Tests\entities;

class TestController
{
  public static function show($userId, $testModelId)
  {
    return "Hi i'm user Id: " . $userId . "and here is my testModelId:" . $testModelId;
  }
}