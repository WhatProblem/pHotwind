<?php
$app->get('/getTest', 'AppHome:hometest');
$app->post('/postTest', 'AppHome:testPost');
$app->put('/putTest', 'AppHome:testPost');
$app->delete('/delTest', 'AppHome:testPost');

// $app->put('/putTest', 'AppHome:hometest');
// $app->delete('/deleteTest', 'AppHome:hometest');
$app->get('/initHome', 'AppHome:initHome');
$app->get('/goodList', 'AppHome:getGoodList');