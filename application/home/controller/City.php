<?php
/**
 * Created by PhpStorm.
 * User: yhlyl
 * Date: 2017/7/14
 * Time: 23:36
 * 空操作是指系统在找不到指定的操作方法的时候，
 * 会定位到空操作（_empty）方法来执行，
 * 利用这个机制，我们可以实现错误页面和一些URL的优化
 */

namespace app\home\controller;


class City
{
    public function _empty($name)
    {
        //把所有城市的操作解析到city方法
        return $this->showCity($name);
    }
    //注意 showCity方法 本身是 protected 方法
    protected function showCity($name)
    {
        //和$name这个城市相关的处理
        return '当前城市:'.$name;
    }
}