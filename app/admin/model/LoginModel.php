<?php
namespace app\admin\model;

use think\facade\Db;
use think\Model;


class LoginModel extends Model
{
//    protected $table = "login";
    public function login($name, $pwd)
    {
        $data = Db::table("user")
            ->where('user_name', $name)
            ->where('user_pwd', $pwd)
            ->find();
        return $data;
    }
//    public function log($id,$city,$ip,$chrome,$time)
//    {
////        $sql = "INSERT INTO `browse`(`browse_ip`, `browse_time`, `browse_name`, `browse_city`)
////                  VALUES ('$ip', '$time', '$chrome', '$city')";
//
//        $data = [
//            "user_id"=>$id,
//            "user_city"=>$city,
//            "user_ip" => $ip,
//            "user_time" =>$time,
//            "user_chrome"=>$chrome
//        ];

//}

}