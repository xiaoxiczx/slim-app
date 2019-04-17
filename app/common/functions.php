<?php
/**
 * 公共模块
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-04-01
 * Time: 21:54
 */

/**
 *
 * 加密函数
 * @param $param [传入需要加密的参数]
 * @return string
 */
function encrypt_validate($param) {
    return md5('site'.uniqid(md5('site' . $param)).'site');
}

function random_str($len = 4) {
    //4.1 定义验证码的内容
    $content = "ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz123456789";
    $captcha = "";
    for ($i = 1; $i <= $len; $i++) {
        // 设置字体内容
        $fontcontent = substr($content, mt_rand(0, strlen($content)), 1);
        $captcha     .= $fontcontent;
    }
    return $captcha;

}


