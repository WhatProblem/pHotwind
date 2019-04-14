<?php
$app->get('/get', 'Admin:testAdmin');
$app->post('/post', 'Admin:testAdmin');
$app->put('/put', 'Admin:testAdmin');
$app->delete('/delete', 'Admin:testAdmin');
$app->post('/upload', 'Admin:upload');
$app->post('/testPost', 'Admin:testPost');

$app->get('/getCategory', 'Admin:getCategory');
$app->post('/addProduct', 'Admin:addProduct');
$app->put('/updateProduct', 'Admin:updateProduct');
$app->delete('/delProduct', 'Admin:delProduct');

// 正式请求
$app->get('/goodsConfig', 'Admin:goodsConfig'); // 数据字典，商品信息配置
$app->post('/addGoods', 'Admin:addGoods'); // 新增商品
$app->get('/getGoods', 'Admin:getGoods'); // 查询商品
$app->put('/editGoods', 'Admin:editGoods'); // 修改商品
$app->delete('/delGoods', 'Admin:delGoods'); // 删除商品