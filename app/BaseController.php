<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
declare (strict_types = 1);

namespace app;

use think\App;
use think\exception\ValidateException;
use think\Validate;

/**
 * 控制器基础类
 */
abstract class BaseController
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected $request;

    /**
     * 应用实例
     * @var \think\App
     */
    protected $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected $middleware = [];

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;

        // 控制器初始化
        $this->initialize();
    }

    // 初始化
    protected function initialize()
    {}

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, $validate, array $message = [], bool $batch = false)
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                list($validate, $scene) = explode('.', $validate);
            }
            $class = false !== strpos($validate, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }
    function xss($type)
    {
        $str  =   trim($type);              //清理空格
        $str  =   strip_tags($str);         //过滤html标签
        $str  =   htmlspecialchars($str);   //将字符内容转化为html实体
        $str  =   addslashes($str);
        return   $str;
    }
    /**
     * @return string
     * 浏览器身份验证
     */
    function getBrowser(){
        $agent=$_SERVER["HTTP_USER_AGENT"];
        if(strpos($agent,'MSIE')!==false || strpos($agent,'rv:11.0')) //ie11判断
            return "ie";
        else if(strpos($agent,'Firefox')!==false)
            return "firefox";
        else if(strpos($agent,'Chrome')!==false)
            return "chrome";
        else if(strpos($agent,'Opera')!==false)
            return 'opera';
        else if((strpos($agent,'Chrome')==false)&&strpos($agent,'Safari')!==false)
            return 'safari';
        else
            return 'unknown';
    }
    /**
     * 客户端IP
     */
    function getIp()
    {
        if(isset($_SERVER)){
            if(isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
                $realip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }elseif(isset($_SERVER['HTTP_CLIENT_IP'])) {
                $realip = $_SERVER['HTTP_CLIENT_IP'];
            }else{
                $realip = $_SERVER['REMOTE_ADDR'];
            }
        }else{
            if(getenv("HTTP_X_FORWARDED_FOR")){
                $realip = getenv( "HTTP_X_FORWARDED_FOR");
            }elseif(getenv("HTTP_CLIENT_IP")) {
                $realip = getenv("HTTP_CLIENT_IP");
            }else{
                $realip = getenv("REMOTE_ADDR");
            }
        }
        return $realip;
    }
    /**
     * 客户端城市
     */
    function getCity ($ip) {
        $url     = "http://ip.taobao.com/service/getIpInfo.php?ip=$ip";
        $info    = json_decode(file_get_contents($url),true);
        $country = $info['data']['country'];
        $region  = $info['data']['region'];
        $city    = $info['data']['city'];
        $isp     = $info['data']['isp'];
        $city    = $country.$region.$city.$isp;
        return   $city;
    }

    /**
     * 错误处理
     */
    function error($data)
    {
        echo "<script>alert('$data');history.go(-1);</script>";
    }
}
