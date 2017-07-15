<?php
/**
 * Created by PhpStorm.
 * User: yhlyl
 * Date: 2017/7/14
 * Time: 22:40
 * 前置方法
 */
namespace app\home\controller;
use think\Controller;

class Qz extends Controller
{
    protected $beforeActionList = [
        'first',//first所有方法的前置方法
        'second' =>  ['except'=>'hello'],//second除了hello方法的前置方法
        'three'  =>  ['only'=>'hello,data'],//three是hello,data方法的前置方法
    ];


    public function first()
    {
        echo 'first<br/>';
    }

    public function second()
    {
        echo 'second<br/>';
    }

    public function three()
    {
        echo 'three<br/>';
    }

    public function hello()
    {
        return 'hello';
    }

    public function data()
    {
        return 'data';
    }
}