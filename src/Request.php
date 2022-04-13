<?php


namespace Source;

class Request
{

  /**
   * @var string $uri
   */
  public string $uri;

  public function __construct($uri)
  {
    $this->uri = $uri;
  }



}