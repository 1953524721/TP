<?php
namespace app\admin\model;

use think\facade\Db;
use think\Model;

class ShowModel extends Model
{
    /**
     * @param $name
     * @param $pwd
     * @return array|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 查询角色
     */
    public function role($uid)
    {
        $data = $this->userName($uid);
        $role = Db::table("role")
            ->where("role_id",$data['role_id'])
            ->find();
        return $role;
    }
    /**
     * @param $uid
     * @return array|Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 查询用户角色关联
     */
    public function userName($uid)
    {
        $data = Db::table("user_role")
            ->where("user_id",$uid)
            ->find();
        return $data;
    }

    /**
     * @param $uid
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 查询用户信息
     */
    public function User($uid)
    {
        $data = Db::table("user")
            ->where("user_id",$uid)
            ->find();
        return $data['user_name'];
    }
}