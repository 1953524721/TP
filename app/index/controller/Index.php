<?php
namespace app\index\controller;

use app\index\model\browse;
use app\BaseController;
use think\facade\Db;
use think\facade\Env;
use think\facade\View;

class Index extends BaseController
{
    public function index()
    {
        $this->log();
        return View::fetch("index");
    }
    public function  log()
    {

        $ip     = $this->getIp();
        $city   = $this->getCity($ip);
        $chrome = $this->getBrowser();
        $time   = date("Y-m-d H:i:s");
        $data = [
            "browse_city"=>$city,
            "browse_ip" => $ip,
            "browse_time" =>$time,
            "browse_chrome"=>$chrome
        ];
        $res =  browse::create($data);
        if ($res)
        {
            return "1";
        }
        else
        {
            return "2";
        }
    }
}
