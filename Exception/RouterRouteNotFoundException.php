<?php

namespace Exception;

use Exception;

class RouterRouteNotFoundException extends Exception
{
  public $message = 'Route not found';
}