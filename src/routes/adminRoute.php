<?php
$app->get('/get', 'Admin:testAdmin');
$app->post('/post', 'Admin:testAdmin');
$app->put('/put', 'Admin:testAdmin');
$app->delete('/delete', 'Admin:testAdmin');

$app->get('/getCategory', 'Admin:getCategory');
$app->post('/addProduct', 'Admin:addProduct');