<?php
namespace app\admin\controller;

use app\admin\model\ShowModel;
use app\Request;
use think\App;
use app\BaseController;
use think\facade\Session;
use think\facade\Log;
use think\middleware\SessionInit;
use think\facade\View;

class Show extends BaseController
{
    public function index(Request $request)
    {
        $uid =  Session::get("uid");
        if ($uid=="")
        {
            $this->error("皮");
        }
        $role = $this->role($uid);
        $User = $this->userName($uid);
        View::assign('role', $role);
        View::assign('User', $User);
        return View::fetch("main");
    }
    private function role($u_id)
    {
        $uid  = Session::get("uid");
        if ($uid!=$u_id)
        {
            $error = array(
                "status"=>"000",
                "data"=>"未知错误"
            );
            return json_encode($error);
        }
        $Show = new ShowModel();
        $data = $Show->role($uid);
        return $data['role_name'];
    }
    private function userName($u_id)
    {
        $uid  = Session::get("uid");
        if ($uid!=$u_id)
        {
            $error = array(
                "status"=>"000",
                "data"=>"未知错误"
            );
            return json_encode($error);
        }
        $Show = new ShowModel();
        $data = $Show->User($uid);
        return $data;
    }
}