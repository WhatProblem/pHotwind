<?php
$app->get('/get', 'Admin:testAdmin');
$app->post('/post', 'Admin:testAdmin');
$app->put('/put', 'Admin:testAdmin');
$app->delete('/delete', 'Admin:testAdmin');

$app->get('/getCategory', 'Admin:getCategory');
$app->post('/addProduct', 'Admin:addProduct');
$app->put('/updateProduct', 'Admin:updateProduct');
$app->delete('/delProduct', 'Admin:delProduct');

// 正式请求
$app->get('/goodsConfig', 'Admin:goodsConfig');