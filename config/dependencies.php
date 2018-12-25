<?php
$container = $app->getContainer();

/**
 * Note: 日志报告
 */
$container['logger'] = function ($c) {
  $logger = new \Monolog\Logger('my_logger');
  $file_handler = new \Monolog\Handler\StreamHandler("./logs/app.log");
  $logger->pushHandler($file_handler);
  return $logger;
};

// $this->logger->addInfo("Something interesting happened");

/**
 * Note: 数据库配置
 */
$container['db'] = function ($c) {
  $db = $c['settings']['db'];
  $pdo = new PDO(
    "mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
    $db['user'],
    $db['pass'],
    $db['options']
  );
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  return $pdo;
};

/**
 * NOTE: 后台admin配置
 */
$container['Admin'] = function ($container) {
  return new \Src\Admin\Admin($container);
};


/**
 * Note: 路由配置
 */
$container['Home'] = function ($container) {
  return new \Src\App\Home($container);
};