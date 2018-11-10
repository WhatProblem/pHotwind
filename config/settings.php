<?php
// 基础配置
return [
  'settings' => [
    'displayErrorDetails' => true,
    'addContentLengthHeader' => true,
    'db' => [
      'host' => 'localhost',
      'dbname' => 'wslifestyle',
      'user' => 'root',
      'pass' => '',
      'options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
    ]
  ]
];