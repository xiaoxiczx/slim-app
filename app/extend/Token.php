<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-02-15
 * Time: 18:30
 */

namespace app\extend;


use app\http\Common;

class Token
{
    private static $token;


    /**
     * 生成token
     * @return string
     */
    public static function createToken()
    {
        $token = md5(encrypt_validate(random_str(6)) . time()) . '-' . md5(encrypt_validate(random_str(6)) . time());
        return $token;
    }

    /**
     * 获取token
     * @return bool|mixed
     */
    public static function get($token)
    {
//        return self::$prefix . $token;
        var_export(Redis::get($token));
    }

    /**
     * 设置token
     * @param $token
     * @return bool
     */
    public static function set()
    {
        // 创建token，并存入缓存
        $token = Token::createToken();
        Redis::setex($token, $token, 2 * 60 * 60, false);
        return $token;
    }


    /**
     * 删除token
     * @param $token
     */
    public static function del($token)
    {
        Cache::del($token);
    }
}