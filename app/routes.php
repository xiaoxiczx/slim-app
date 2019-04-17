<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-01-25
 * Time: 11:02
 */


use app\extend\Cache;
use app\extend\Redis;

$app = new \Slim\App($config);

$app->get('/index', function () {

    Redis::set("username", "陈志祥");
});

$app->get('/get/{name}', function ($args) {
//    var_export($args);
    echo \app\extend\Token::get("5f7c27a5a59f602a0299e36a35cd8bcb-3e058f93059e8cfeaccf626bcbdc54af");
});

$app->get('/del', function () {
    try {
        Cache::del("name");
    }catch (Exception $e) {
        echo 11;
    }
});

$app->post('/login', \app\http\v1\controller\Login::class . ':login');





