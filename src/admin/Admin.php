<?php

/**
 * NOTE: 后台admin配置
 */
namespace Src\Admin;

class Test
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

  public function testAdmin($request, $response)
  {
    $this->logger->addInfo('测试后台admin信息');
    $resp = ['msg' => 'successfully!'];
    return $this->response->withJson($resp);
  }
}