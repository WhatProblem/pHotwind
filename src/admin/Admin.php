<?php

/**
 * NOTE: 后台admin配置
 */
namespace Src\Admin;

class Admin
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
   * Note:公共返回数据结构
   * msg:返回信息值
   * status: 返回状态码
   */
  private function respJson($data = null, $status = 200, $msg = 'successfully!')
  {
    return [
      'msg' => $msg,
      'status' => $status,
      'data' => $data
    ];
  }

  /**
   * Note: 转换请求数据变为数组 
   */
  private function findCategoryFile($types = null)
  {
    $jsonString = file_get_contents('./public/productInfo.json');
    $dataArr = json_decode($jsonString, true);
    if ($types) {
      foreach ($dataArr as $key => $value) {
        if ($key == $types) {
          return $value['product'];
        }
      }
    } else {
      return $dataArr;
    }
  }

  /** 
   * Note: 个人测试使用
   */
  public function testAdmin($request, $response)
  {
    $json_string = file_get_contents('./public/productInfo.json');
    $data = json_decode($json_string, true);
    $this->logger->addInfo('测试后台admin信息');
    $resp = self::respJson($data);
    return $this->response->withJson($resp);
  }

  /** 
   * Note: 获取商品分类
   */
  public function getCategory($request, $response)
  {
    $this->logger->addInfo('获取分类商品');
    $req = $request->getUri()->getQuery();
    if ($req) {
      $params = $request->getQueryParams()['category_type'];
    } else {
      $params = null;
    }
    $data = self::findCategoryFile($params);
    $status = 200;
    $msg = '查询成功';
    $resp = self::respJson($data, $status, $msg);
    return $this->response->withJson($resp);
  }

  /**
   * 新增商品接口
   */
  public function addProduct($request, $response)
  {
    $this->logger->addInfo('新增产品');
    $bodyParams = $request->getParsedBody();
    $table = 'girl_clothe';
    $product_code = 'HTGC' . $bodyParams['product_type'] . '0001' . time();
    $bodyParams['product_code'] = $product_code;
    $bodyParam = [];
    foreach ($bodyParams as $key => $value) {
      $bodyParam[':' . $key] = $value;
    }
    $sql = 'INSERT INTO ' . $table . '(' . implode(',', array_keys($bodyParams)) . ') VALUES (' . implode(',', array_keys($bodyParam)) . ')';
// $sqlArr = [':user_id' => $user_id, ':film_id' => $film_id, ':film_talk_content' => $film_talk_content];
    $sth = $this->db->prepare($sql);
    $sth->execute($bodyParam);
    $code = $sth->errorCode();
    if ($code == 00000) {
      $resp = self::respJson();
    } else {
      $resp = self::respJson(null, $status = 500, $msg = 'failed!');
    }
    return $this->response->withJson($resp);
  }

  /**
   * Note:修改商品信息
   */
  public function updateProduct($request, $response)
  {
    $this->logger->addInfo('修改产品');
    $bodyParams = $request->getParsedBody();
    $table = 'girl_clothe';
    $id = $bodyParams['id'];
    $resp = $this->respJson($id, $status = 200, $msg = 'successfully!');
    return $this->response->withJson($resp);
  }

  /**
   * Note:删除商品信息
   */
  public function delProduct($request, $response)
  {
    $this->logger->addInfo('删除商品');
    $queryParams = $request->getQueryParams();
    $table = 'girl_clothe';
    $id = $queryParams['id'];
    $resp = $this->respJson($id, $status = 200, $msg = 'delete successfully');
    return $this->response->withJson($resp);
  }
}