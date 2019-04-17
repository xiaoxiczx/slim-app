<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-01-23
 * Time: 22:35
 */

$config = [
    'settings' => [
        'displayErrorDetails' => false, //开启debug模式
        'db'                  => [
            'database_type' => 'mysql',
            'database_name' => 'site',
            'server'        => '127.0.0.1',
            'username'      => '',
            'password'      => '',
            'charset'       => 'utf8',
            'prefix'        => 'site_'
        ],
        'redis'               => [
            'host'     => '127.0.0.1',
            'port'     => '6379',
            'password' => ''
        ]

    ],

];
