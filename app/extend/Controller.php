<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-01-24
 * Time: 20:33
 */

namespace app\extend;


use app\extend\Token;
use app\http\Common;
use app\model\AdminUserModel;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Controller
{
    protected $redisHots = '127.0.0.1';
    protected $redisPort = 6379;
    private $token = '';
    protected static $ci;

    protected $getMethod = '';
    public function __construct(ContainerInterface $ci)
    {
        header('Access-Control-Allow-Origin: *');
        self::$ci = $ci;

    }

    public static function db()
    {
        return self::$ci->db;
    }

    public static function getRandStr($str)
    {
        //4.1 定义验证码的内容
        $content = "ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz123456789";
        $captcha = "";
        for ($i = 1; $i <= $str; $i++) {
            // 设置字体内容
            $fontcontent = substr($content, mt_rand(0, strlen($content)), 1);
            $captcha     .= $fontcontent;
        }
        return $captcha;
    }


    /**
     * redis连接实例
     * @return \Redis
     */
    public function getRedisInstance()
    {
        $redis = new \Redis();
        $redis->connect($this->redisHots, $this->redisPort);
        return $redis;
    }

    /**
     * token验证 true token正确， false token错误
     * @param $token_validate
     * @return bool
     */
    public function userTokenValidate($token_validate)
    {
        $token = Token::get('token');
        // 服务器保存的token和用户传递过来的token比对，是不是唯一用户
        if ($token == $token_validate) {
            return true;
        }

        return false;
    }

}