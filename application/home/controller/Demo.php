<?php
/**
 * Created by PhpStorm.
 * User: yhlyl
 * Date: 2017/7/14
 * Time: 22:54
 *  跳转和重定向
 */

namespace app\home\controller;

use think\Controller;
use app\home\model\User;

class Demo extends Controller
{
    public function index()
    {
        $User = new User; //实例化User对象
        $data = [];
        $result = $User->save($data);
        if($result){
            //设置成功后跳转页面的地址，默认的返回页面是$_SERVER['HTTP_REFERER']
            $this->success('新增成功', 'index/myview','',10);
        } else {
            //错误页面的默认跳转页面是返回前一页，通常不需要设置
            $this->error('新增失败','hello','x');
        }
    }

    public function hello()
    {
        //跳转和重定向的URL地址不需要再使用url方法进行生成，会自动调用，请注意避免，否则会导致多次生成而出现两个重复的URL后缀
        //重定向301和302的区别???
        //$this->redirect('http://thinkphp.cn/blog/2',301);
        //$this->redirect('http://thinkphp.cn/blog/2',302);
        //重定向到Index模块的Index操作
        $this->redirect('Index/Index/index', ['cate_idQ' => '你好PHP'])->remember();
        //使用redirect助手函数还可以实现更多的功能，例如可以记住当前的URL后跳转
        //redirect('News/category')->remember();
        //需要跳转到上次记住的URL的时候使用：
        //redirect()->restore();
    }
}