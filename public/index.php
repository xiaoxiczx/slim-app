<?php
/**
 * 项目入口文件
 * by.陈志祥
 */
use Medoo\Medoo;

use app\http\v1\controller\Login;

require '../vendor/autoload.php';
require '../app/config.php';
require '../app/routes.php';

$container         = $app->getContainer();
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('path/to/templates', [
        'cache'       => false,
        'auto_reload' => false
    ]);
    $view->addExtension(new \Slim\Views\TwigExtension(
        $container['router'],
        $container['request']->getUri()
    ));

    return $view;
};

$container['db']   = function ($config) {
    return new Medoo($config['settings']['db']);
};


$app->run();


