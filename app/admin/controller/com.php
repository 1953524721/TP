<?php
namespace app\admin\controller;

use think\App;
use think\Controller;

class com extends Controller
{
    public function __construct(App $app = null)
    {
        parent::__construct($app);
    }
    public function L001()
    {
        echo "L001";
    }

}