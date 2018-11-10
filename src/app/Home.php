<?php

/**
 * Note: home模块
 * req，res
 */

namespace Src\App;

class Home
{
  protected $container;

  public function __construct($container)
  {
    $this->container = $container;
  }

  public function __get($property)
  {
    if ($this->container->{$property}) {
      return $this->container->{$property};
    }
  }

  public function hometest($request, $response)
  {
    $this->logger->addInfo("Something interesting happened");
    $resp = ['msg' => 'successfully!'];
    return $this->response->withJson($resp);
  }
}