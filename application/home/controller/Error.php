<?php
/**
 * Created by PhpStorm.
 * User: yhlyl
 * Date: 2017/7/14
 * Time: 23:42
 * 空控制器的概念是指当系统找不到指定的控制器名称的时候，
 * 系统会尝试定位空控制器(Error)，
 * 利用这个机制我们可以用来定制错误页面和进行URL的优化。
 * 更改默认的空控制器名
 * 'empty_controller' => 'MyError',
 */

namespace app\home\controller;

use think\Request;

class Error
{
    public function index(Request $request)
    {
        //根据当前控制器名来判断要执行那个城市的操作
        $cityName = $request->controller();
        return $this->city($cityName);
    }

    //注意 city方法 本身是 protected 方法
    protected function city($name)
    {
        //和$name这个城市相关的处理
        return '当前城市' . $name;
    }

}