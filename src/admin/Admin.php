<?php

/**
 * NOTE: 后台admin配置
 */
namespace Src\Admin;

class Admin
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

  /**
   * Note: 获取商品配置信息
   * 查询静态文件
   * @return {json对象}
   */
  public function goodsConfig($request, $response)
  {
    $json_string = file_get_contents('./public/productInfo.json');
    $data = json_decode($json_string, true);
    $this->logger->addInfo('获取静态文件数据');
    $resp = $this->respJson($data);
    return $this->response->withJson($resp);
  }

  /**
   * Note: 文件上传
   */
  public function upload($request, $response)
  {
// var_export($_FILES);
    if ($_FILES['file']['error'] > 0) {
      switch ($_FILES['file']['error']) {
//错误码不为0，即文件上传过程中出现了错误
        case '1':
          echo '文件过大';
          break;
        case '2':
          echo '文件超出指定大小';
          break;
        case '3':
          echo '只有部分文件被上传';
          break;
        case '4':
          echo '文件没有被上传';
          break;
        case '6':
          echo '找不到指定文件夹';
          break;
        case '7':
          echo '文件写入失败';
          break;
        default:
          echo "上传出错<br/>";
      }
    } else {
      $MAX_FILE_SIZE = 200000;
      if ($_FILES['file']['size'] > $MAX_FILE_SIZE) {
        exit("文件超出指定大小");
      }
      $allowSuffix = array('jpg', 'gif', 'jpeg', 'png');
      $myImg = explode('.', $_FILES['file']['name']);
      $myImgSuffix = array_pop($myImg);
      if (!in_array($myImgSuffix, $allowSuffix)) {
        exit("文件后缀名不符");
      }
      $allowMime = array("image/jpg", "image/jpeg", "image/pjpeg", "image/gif", "image/png");
      if (!in_array($_FILES['file']['type'], $allowMime)) {
        exit('文件格式不正确，请检查');
      }
      $path = "public/images/goods/";
      $random = date('Y') . date('m') . date("d") . date('H') . date('i') . date('s') . rand(0, 9);
      $name = $random . '.' . $myImgSuffix;
      $barcode = 'HW' . $random;
      if (is_uploaded_file($_FILES['file']['tmp_name'])) {
        if (move_uploaded_file($_FILES['file']['tmp_name'], $path . $name)) {
// echo "上传成功";
          return [
            'picurl' => $this->addr . '/' . $path . $name,
            'barcode' => $barcode
          ];
        } else {
          echo '上传失败';
        }
      } else {
        echo '不是上传文件';
      }
    }
  }

  /**
   * Note: 新增商品
   */
  public function addGoods($request, $response)
  {
    $this->logger->addInfo('新增商品');
    $barcode_pic = $this->upload($request, $response);
    $bodyParams = json_decode($request->getParsedBody()['param']);
    if ($bodyParams->onsale_info == 0) {
      $cut_now = '';
      $mail_free = '';
      $cut_nows = '';
      $mail_frees = '';
      $onsale_infoarr = [];
    } else if ($bodyParams->onsale_info == 1) {
      $cut_now = ',cut_now';
      $mail_free = '';
      $cut_nows = ',:cut_now';
      $mail_frees = '';
      $onsale_infoarr = [':cut_now' => $bodyParams->onsale_infoVal];
    } else if ($bodyParams->onsale_info == 2) {
      $cut_now = '';
      $mail_free = ',mail_free';
      $cut_nows = '';
      $mail_frees = ',:mail_free';
      $onsale_infoarr = [':mail_free' => $bodyParams->onsale_infoVal];
    } else if ($bodyParams->onsale_info == 3) {
      $cut_now = ',cut_now';
      $mail_free = ',mail_free';
      $cut_nows = ',:cut_now';
      $mail_frees = ',:mail_free';
      $onsale_infoarr = [':cut_now' => $bodyParams->onsale_infoVal, ':mail_free' => $bodyParams->onsale_infoVal];
    }
    $sql = "INSERT INTO goods (type_id, category_type, goods_name,goods_price,goods_color,goods_discount,onsale_info,isnew,picurl,sale_type,barcode $cut_now $mail_free) 
VALUES (:type_id, :category_type, :goods_name, :goods_price, :goods_color, :goods_discount, :onsale_info, :isnew, :picurl, :sale_type, :barcode $cut_nows $mail_frees)";
    $sqlArr = [
      ':type_id' => $bodyParams->type_id,
      ':category_type' => $bodyParams->category_type,
      ':goods_name' => $bodyParams->goods_name,
      ':goods_price' => $bodyParams->goods_price,
      ':goods_color' => $bodyParams->goods_color,
      ':goods_discount' => $bodyParams->goods_discount,
      ':onsale_info' => $bodyParams->onsale_info,
      ':isnew' => $bodyParams->isnew,
      ':picurl' => $barcode_pic['picurl'],
      ':barcode' => $barcode_pic['barcode'],
      ':sale_type' => $bodyParams->sale_type
    ];
    $insertArr = array_merge($sqlArr, $onsale_infoarr);
    $sth = $this->db->prepare($sql);
    $sth->execute($insertArr);
    $code = $sth->errorCode();
    if ($code == 00000) {
      $res = ['msg' => 'successfully!', 'code' => 200];
    } else {
      $res = ['msg' => 'failed', 'code' => 201];
    }
    $resp = $this->respJson($res);
    return $this->response->withJson($resp);
  }

  /**
   * Note: 查询商品列表
   */
  public function getGoods($request, $response)
  {
    $this->logger->addInfo('查询商品列表');
    $queryParams = $request->getQueryParams();
    $offsets = $queryParams['offsets'];
    $pages = ($queryParams['pages'] - 1) * $offsets;
    if (isset($queryParams['barcode'])) {
      $sql = "SELECT * FROM goods WHERE barcode=:barcode ORDER BY id DESC LIMIT $pages, $offsets";
      $sth = $this->db->prepare($sql);
      $queryArr = [':barcode' => $queryParams['barcode']];
      $sth->execute($queryArr);
    } else {
      $sql = "SELECT * FROM goods ORDER BY id DESC LIMIT $pages, $offsets";
      $sth = $this->db->prepare($sql);
      $sth->execute();
    }
    $result = $sth->fetchAll();
    $resp = $this->respJson($result);
    return $this->response->withJson($resp);
  }

  /**
   * Note: 商品修改
   */
  public function editGoods($request, $response)
  {
    $this->logger->addInfo('修改商品');
    $bodyParams = $request->getParsedBody();
    if ($bodyParams['onsale_info'] == 0) {
      $cut_now = '';
      $mail_free = '';
      $onsale_infoarr = [];
    } else if ($bodyParams['onsale_info'] == 1) {
      $cut_now = ',cut_now=:cut_now';
      $mail_free = '';
      $onsale_infoarr = [':cut_now' => $bodyParams['onsale_infoVal']];
    } else if ($bodyParams['onsale_info'] == 2) {
      $cut_now = '';
      $mail_free = ',mail_free=:mail_free';
      $onsale_infoarr = [':mail_free' => $bodyParam['onsale_infoVal']];
    } else if ($bodyParams['onsale_info'] == 3) {
      $cut_now = ',cut_now=:cut_now';
      $mail_free = ',mail_free=:mail_free';
      $onsale_infoarr = [':cut_now' => $bodyParams['onsale_infoVal'], ':mail_free' => $bodyParams['onsale_infoVal']];
    }
    $sql = "UPDATE goods SET type_id=:type_id, category_type=:category_type, goods_name=:goods_name,goods_price=:goods_price,goods_color=:goods_color,goods_discount=:goods_discount,onsale_info=:onsale_info,isnew=:isnew,sale_type=:sale_type $cut_now $mail_free WHERE id = :id";
    $sqlArr = [
      ':type_id' => $bodyParams['type_id'],
      ':category_type' => $bodyParams['category_type'],
      ':goods_name' => $bodyParams['goods_name'],
      ':goods_price' => $bodyParams['goods_price'],
      ':goods_color' => $bodyParams['goods_color'],
      ':goods_discount' => $bodyParams['goods_discount'],
      ':onsale_info' => $bodyParams['onsale_info'],
      ':isnew' => $bodyParams['isnew'],
      ':sale_type' => $bodyParams['sale_type'],
      ':id' => $bodyParams['id'],
    ];
    $updateArr = array_merge($sqlArr, $onsale_infoarr);
    $sth = $this->db->prepare($sql);
    $sth->execute($updateArr);
    $code = $sth->errorCode();
    if ($code == 00000) {
      $res = ['msg' => 'successfully!', 'code' => 200];
    } else {
      $res = ['msg' => 'failed', 'code' => 201];
    }
    $resp = $this->respJson($res);
    return $this->response->withJson($resp);
  }

  /**
   * Note: 删除商品
   */
  public function delGoods($request, $response)
  {
    $this->logger->addInfo('删除商品');
    $goodsId = $request->getQueryParams()['id'];
    $barcode = $request->getQueryParams()['barcode'];
    $sql = "DELETE FROM goods WHERE id=:id";
    $sqlArr = [':id' => $goodsId];
    $sth = $this->db->prepare($sql);
    $sth->execute($sqlArr);
    $code = $sth->errorCode();
    if ($code == 00000) {
      $res = ['msg' => 'successfully!', 'code' => 200];
    }
    $img = substr($barcode, 2) . '.jpg';
    $path = 'public/images/goods/';
    unlink($path . $img); // 删除图片
    $resp = $this->respJson($res);
    return $this->response->withJson($resp);
  }
}