<?php

/**
 * Note: AppHome模块
 * req，res
 */

namespace Src\App;

class AppHome
{
  protected $container;
  protected $addr = 'http://www.wslifestyle.com';

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

  private function resultStatus($data)
  {
    return [
      'msg' => 'successful',
      'code' => 200,
      'data' => $data
    ];
  }

  /**
   * NOTE: home部分数据获取
   * table: 表名
   * sort_type: 字段名
   * banner: 部分
   * theme: 主题部分
   * sorts: 男女装分类导航部分,sort_type:0女装分类
   */
  private function homeCommon($table, $sort_type)
  {
    $this->logger->addInfo('init home' . $table);
    if (isset($sort_type) && $table == 'sorts') { // 男女装分类部分
      $sql = 'SELECT * FROM ' . $table . ' WHERE sort_type=' . $sort_type . ' ORDER BY sort_navid ASC';
      $sth = $this->db->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll();
    } else if (isset($table) && $table == 'saletype') {
      $sql = 'SELECT * FROM ' . $table . ' WHERE sale_type=' . $sort_type . ' ORDER BY sale_type_order ASC';
      $sth = $this->db->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll();
    } else if (isset($table) && $table == 'fashion') {
      $sql = 'SELECT * FROM ' . $table . ' WHERE fashion_type=' . $sort_type;
      $sth = $this->db->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll();
    } else if (isset($table) && $table == 'goods') {
      $sql = 'SELECT * FROM ' . $table . ' WHERE sale_type=' . $sort_type;
      $sth = $this->db->prepare($sql);
      $sth->execute();
      $result = $sth->fetchAll();
    } else {
      $sth = $this->db->prepare('SELECT * FROM ' . $table);
      $sth->execute();
      $result = $sth->fetchAll();
    }
    return $result;
  }

  public function getGoods($table, $type_id, $category_type)
  {
    $sql = 'SELECT * FROM ' . $table . ' WHERE type_id=' . $type_id . ' AND category_type=' . $category_type;
    $sth = $this->db->prepare($sql);
    $sth->execute();
    $result = $sth->fetchAll();
    return $result;
  }

  public function initHome($request, $response)
  {
    $this->logger->addInfo('init home data');
    $banner = $this->homeCommon('banner', null);
    $theme = $this->homeCommon('theme', null);
    $girlSort = $this->homeCommon('sorts', 0, 'girlSort');
    $boySort = $this->homeCommon('sorts', 1, 'boySort');
    $discount = $this->homeCommon('saletype', 1);
    $shopSale = $this->homeCommon('saletype', 2);
    $welfare = $this->homeCommon('saletype', 3);
    $fashion = $this->homeCommon('fashion', 0);
    $fashionSeason = $this->homeCommon('fashion', 1);
    $footer = $this->homeCommon('footer', null);
    $hotSale = $this->homeCommon('goods', 4);

    $girlsOne = $this->getGoods('goods', 0, 0);
    $girlsTwo = $this->getGoods('goods', 0, 1);
    $girlsThree = $this->getGoods('goods', 0, 2);
    $girlsFour = $this->getGoods('goods', 0, 3);
    $girls = array_merge($girlsOne, $girlsTwo, $girlsThree, $girlsFour);

    $boysOne = $this->getGoods('goods', 1, 0);
    $boysTwo = $this->getGoods('goods', 1, 1);
    $boysThree = $this->getGoods('goods', 1, 4);
    $boys = array_merge($boysOne, $boysTwo, $boysThree);

    $shoesBagOne = $this->getGoods('goods', 1, 6);
    $shoesBagTwo = $this->getGoods('goods', 0, 6);
    $shoesBagThree = $this->getGoods('goods', 0, 7);
    $shoesBag = array_merge($shoesBagOne, $shoesBagTwo, $shoesBagThree);
    $res = [
      'banner' => $banner,
      'theme' => $theme,
      'girlSort' => $girlSort,
      'boySort' => $boySort,
      'discount' => $discount,
      'shopSale' => $shopSale,
      'welfare' => $welfare,
      'fashion' => $fashion,
      'fashionSeason' => $fashionSeason,
      'footer' => $footer,
      'hotSale' => $hotSale,
      'girls' => $girls,
      'boys' => $boys,
      'shoesBag' => $shoesBag
    ];
    $resp = $this->resultStatus($res);
    return $this->response->withJson($resp);
  }
}