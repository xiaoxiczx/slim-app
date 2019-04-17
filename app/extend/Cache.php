<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-02-13
 * Time: 22:22
 */

namespace app\extend;


use Exception;
use Redis;

/**
 * 缓存类
 * Class Cache
 * @package app\extend
 */
class Cache
{

    private static $cache_path = 'runtime/cache/cache_';//path for the cache
    private static $cache_expire = 3600;//seconds that the cache expires

    // 服务器根目录
    //cache constructor, optional expiring time and cache path
    public function __construct()
    {
        // 获取站点根目录
    }

    /**
     * 缓存文件路径
     * @param $key
     * @return string
     */
    public static function fileName($key)
    {
        return self::getBasePath() . '/' . self::$cache_path . encrypt_validate($key);
    }

    /**
     * 设置缓存
     * @param $key
     * @param $data
     * @param int $exp_time
     * @return bool
     */
    public static function set($key, $data, $exp_time = 3600)
    {

        self::$cache_expire = $exp_time;
        $values             = serialize($data);


        $filename = self::fileName($key);
        // 打开文件
        if (($file = fopen($filename, 'w+')) === false) {
            echo 'open file fail';
        }
        // 写入文件
        if ($file) {//able to create the file
            fwrite($file, $values);
            fclose($file);
            return true;
        } else return false;
    }

    /**
     * 获取缓存内容
     * @param $key
     * @return bool|mixed
     */
    public static function get($key)
    {
        $filename = self::fileName($key);

        if (!file_exists($filename) || !is_readable(self::getBasePath() . $filename)) {//can't read the cache
            return false;
        }
        if (time() < (filemtime($filename) + self::$cache_expire)) {//cache for the key not expired
            $file = fopen( $filename, "r");// read data file
            if ($file) {//able to open the file
                $data = fread($file, filesize($filename));
                fclose($file);
                return unserialize($data);//return the values
            } else return false;
        } else return false;//was expired you need to create new
    }

    /**
     * 缓存删除方法
     * @param $key
     */
    public static function del($key)
    {
        $filename = self::fileName($key);
        if (!unlink($filename)) {
            throw new Exception('找不到文件');
        };
    }

    // 地址
    public static function getBasePath()
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/../';
    }


}
