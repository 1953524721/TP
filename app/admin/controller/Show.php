<?php
namespace app\admin\controller;

use think\App;
use app\BaseController;
use think\facade\Session;
use think\facade\Log;
use think\middleware\SessionInit;
use think\facade\View;

class Show extends BaseController
{
    public function main()
    {
        $uid =  Session::get("uid");
        if ($uid=="")
        {
            $this->error("皮");
        }
        return View::fetch("main");
    }

}