<?php
namespace app\admin\controller;

use app\admin\model\LoginModel;
use app\admin\model\UserLog;
use app\BaseController;
use think\Request;
use think\facade\Session;
use think\facade\View;

class Login extends BaseController
{
    public function index(Request $request)
    {
        $token = $request->buildToken('__token__', 'sha1');
        View::assign('token', $token);
        return View::fetch("index");
    }
    public function loginDo(Request $request)
    {
        if (request()->isAjax()) {
            $check = $request->checkToken('__token__');
            if (false == $check)
            {
                $error = array(
                    "status"=>$check,
                    "data"=>"皮"
                );
                return json_encode($error);
            }
            $data = request()->post();
            $name = $this->xss($data['name']);
            $pwd  = $this->xss($data['pwd']);
            $name_len = strlen($name);
            $pwd_len  = strlen($pwd);
            if (empty($name_len)||empty($pwd_len))
            {
                $error = array(
                    "status"=>"3",
                    "data"=>"发现空数据"
                );
                return json_encode($error);
            }
            elseif ($name_len<5&&$pwd_len<5)
            {
                $error = array(
                    "status"=>"4",
                    "data"=>"规则不符合"
                );
                return json_encode($error);
            }
            elseif(!preg_match('/[a-zA-Z]/',$pwd))
            {
                $error = array(
                    "status"=>"5",
                    "data"=>"密码中无字母"
                );
                return json_encode($error);
            }
            elseif ($name_len<21&&$pwd_len<21)
            {
//                $host = $_SERVER['HTTP_HOST'];
//                $SERVER_HOST = $_SERVER['$_SERVER["SERVER_ADDR"]'];
//                if ($_SERVER['PATH_INFO'] == "\/admin\/Login\/index")
//                {
                    $user = new LoginModel();
                    $user_data = $user->login($name, md5($pwd));
                    if(empty($user_data))
                    {
                        $error = array(
                            "status"=>"1",
                            "data"=>"账户名或密码错误"
                        );
                        return json_encode($error);
                    }
                    else
                    {
                        $status  = $user_data['user_status'];
                        if ($status=='1')
                        {
                            $user_id = $user_data['user_id'];
                            $data = $this->log($user_id);
                            if ($data == "1")
                            {
                                Session::set("uid",$user_id);

                                if (empty(Session::get("uid")))
                                {
                                    $error = array(
                                        "status"=>"8",
                                        "data"=>"NET ERROR"
                                    );
                                    return json_encode($error);

                                }
                                else
                                {
                                    $error = array(
                                        "status"=>"2",
                                        "data"=>"成功"
                                    );
                                    return json_encode($error);
                                }
                            }
                            else
                            {
                                $error = array(
                                    "status"=>"7",
                                    "data"=>"NET ERROR"
                                );
                                return json_encode($error);
                            }

                        }
                        else
                        {
                            $error = array(
                                "status"=>"6",
                                "data"=>"冻结"
                            );
                            return json_encode($error);
                        }

                    }
//                } else {
//                    $error = array(
//                        "status" => "0",
//                        "data" => "未知请求",
//                    );
//                    return json_encode($_SERVER['PATH_INFO']);
//                }
            }
        }
    }
    public function  log($uid)
    {

        $ip     = "180.163.220.66";
        $city   = $this->getCity($ip);
        $chrome = $this->getBrowser();
        $time   = date("Y-m-d H:i:s");
        $data = [
            "user_id"=>$uid,
            "user_city"=>$city,
            "user_ip" => $ip,
            "user_time" =>$time,
            "user_chrome"=>$chrome
        ];
        $res =  UserLog::create($data);
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