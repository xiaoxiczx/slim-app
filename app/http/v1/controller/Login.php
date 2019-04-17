<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-04-01
 * Time: 21:55
 */

namespace app\http\v1\controller;


use app\extend\Controller;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Login extends Controller
{

    public function login(ServerRequestInterface $request, ResponseInterface $response)
    {
        echo encrypt_validate(123456);die;
        $param = $request->getParsedBody();
        var_export($param);
    }

}