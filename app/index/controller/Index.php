<?php
namespace app\index\controller;

use app\BaseController;
use think\facade\Db;
use think\facade\Env;
use think\facade\View;

class Index
{
    public function index()
    {
        return View::fetch("index");
    }

}
