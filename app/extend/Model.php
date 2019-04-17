<?php
/**
 * Created by PhpStorm.
 * User: chenzx
 * Date: 2019-02-12
 * Time: 16:46
 */

namespace app\extend;


use Interop\Container\ContainerInterface;

class Model
{

    private  $ci;
    protected  $table;
    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    /**
     * 数据库连接
     * @return DB
     */
    private function db(){
        return $this->ci->db;
    }

    /**
     * 查询所有管理员
     * @param string $param
     * @param array $where
     * @return array
     */
    public function all($param = '*', $where = [])
    {
        return $this->db()->select($this->table, $param, $where);
    }

    /**
     * 根据用户id查询用户
     * @param array $param
     * @param array $where
     * @return array
     */
    public function find($param = [], $where = [])
    {
        return $this->db()->get($this->table, $param, $where);
    }

    /**
     * 添加管理员并返回添加主键id
     * @param array $param
     * @return int
     */
    public function insertGetId($param = [])
    {
        $this->db()->insert($this->table, $param);
        return $this->db()->id();
    }

    /**
     * 添加管理员
     * @param array $param
     * @return int
     */
    public function insert($param = [])
    {
        return $this->db()->insert($this->table, $param);

    }

    /**
     * 删除管理员
     * $bool为true则是删除真实数据, false 则是逻辑上的删除
     * @param $id
     * @param bool $bool
     * @return mixed
     */
    public function delete($id, $bool = false)
    {

        if ($bool) {
            // 删除真实数据，慎用！
            $rowCount = $this->db()->delete($this->table, [
                $id => $id
            ]);
        }else {
            // 逻辑上的删除
            $rowCount = $this->db()->update($this->table, [
                'deleted' => 1
            ], [
                'id' => $id
            ]);
        }

        return $rowCount;
    }

    /**
     * 修改管理员
     * @param $param
     * @param $id
     * @return mixed
     */
    public function update($param, $id)
    {
        return $this->db()->update($this->table, $param, [
            'id' => $id
        ]);
    }



}
