<?php

/**
 * Note: AppHome模块
 * req，res
 */

namespace Src\App;

class AppHome
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

  /**
   * NOTE: get方法测试
   */
  public function hometest($request, $response)
  {
    $this->logger->addInfo('Something interesting happened');
    $req = $request->getQueryParams();
    $resp = ['msg' => 'successfully!', 'req' => $req['class_id']];
    return $this->response->withJson($resp);
  }

  /**
   * NOTE: post方法测试
   */
  public function testPost($request, $response)
  {
    $this->logger->addInfo('Something interesting happened');
    $req = $request->getParsedBody();
    $resp = ['msg' => 'successfully!', 'req' => $req['class_id']];
    return $this->response->withJson($resp);
  }
}