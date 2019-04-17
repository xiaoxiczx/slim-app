<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-03-31
 * Time: 22:50
 */

namespace app\extend;


class Redis
{
    private static $redis = null;
    // redis字段前缀
    private static $prefix = "site:";

    // redis主机地址
    private static $host = '127.0.0.1';
    // redis端口号
    private static $port = 6379;
    // redis密码
    private static $password = '';

    /**
     * 添加方法
     * @param $name
     * @param $value
     */
    public static function set($key, $value)
    {
        self::getRedisInstance()->set(self::$prefix . $key, $value);
    }

    /**
     * 设置redis缓存添加及其过期时间
     * @param $name
     * @param $value
     * @param $ttl
     */
    public static function setex($key, $value, $ttl)
    {
        self::getRedisInstance()->setex(self::$prefix . $key, $ttl, $value);
    }

    /**
     * 获取方法
     * @param $key
     * @return bool|string
     */
    public static function get($key)
    {
        return self::getRedisInstance()->get(self::$prefix . $key);
    }

    /**
     * 删除方法
     * @param $key
     */
    public static function del($key)
    {
        self::getRedisInstance()->del(self::$prefix . $key);
    }

    /**
     * redis实例方法
     * @return \Redis|null
     */
    public static function getRedisInstance()
    {
        self::$redis = new \Redis();
        self::$redis->connect(self::$host, self::$port);
        return self::$redis;
    }
}