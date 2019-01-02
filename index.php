<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

header("Content-Type: text/html;application/json;application/x-www-form-urlencoded;image/jpeg;charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
// header("Access-Control-Allow-Headers: Origin,X-Requested-With,Content-Type,Accept");
header("Access-Control-Allow-Methods", "PUT,POST,GET,DELETE,OPTIONS");
header("X-Powered-By", ' 3.2.1');
header("Access-Control-Allow-Credentials", "true");
header("Access-Control-Expose-Headers", "*");

session_start();
require './src/app/AppHome.php';
require './src/admin/Admin.php';
require './vendor/autoload.php';
$settings = require './config/settings.php';

$app = new \Slim\App($settings);

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
  header("Content-Type: text/html;application/json;application/x-www-form-urlencoded;image/jpeg;charset=utf-8");
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
  header('Access-Control-Allow-Methods: GET, POST, PUT,DELETE,OPTIONS,PATCH');
  exit;
}

require './config/dependencies.php';

// 路由
require './src/routes/adminRoute.php';
require './src/routes/appRoute.php';

$app->run();