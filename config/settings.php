<?php
// 基础配置
return [
  'settings' => [
    'displayErrorDetails' => true,
    'addContentLengthHeader' => true,
    'db' => [
      'host' => 'localhost',
      'dbname' => 'hotwind',
      'user' => 'root',
      'pass' => '',
      'options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
    ],
    // 'db' => [
    //   'host' => 'localhost',
    //   'dbname' => 'whatproblem',
    //   'user' => 'whatproblem',
    //   'pass' => 'whatproblem',
    //   'options' => array(PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8')
    // ]
  ]
];