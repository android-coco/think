<?php
namespace app\home\controller;
use think\Controller;

class HelloWorld extends Controller
{

    public function _initialize()
    {
        echo 'init<br/>';
    }

    public function index()
    {
        return 'class HelloWorld';
    }

    public function hello()
    {
        return 'hello';
    }

    public function data()
    {
        return 'data';
    }

    public function x()
    {
        $name = ['name'=>'myview1'];
        return view('index',$name);
    }
}