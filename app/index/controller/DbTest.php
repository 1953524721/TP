<?php

namespace app\index\controller;

use app\BaseController;
use think\facade\Db;

class DbTest extends BaseController
{
    public function demo1()
    {
        $sql  = "SELECT * FROM `L_user`";
        $data = Db::query($sql);
        print_r($data);
    }
    public function demo2()
    {
        $data =  Db::table("L_user")
             ->field('user_name')
             ->select();
        dump($data);
    }
    public function demo3()
    {
        $data =  Db::table("L_user")
            ->field('user_name')
//            ->where("user_id", "=","1")  //字段 操作符 值
//            ->where("user_id", 2)  //等于号可以这样写
                ->where("user_id","between",[1,2])
            ->fetchSql(false)   // TRUE 可以输入SQL
            ->select();
        print_r($data);
    }
}