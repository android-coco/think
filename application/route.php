<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
//多级控制器
// 注册路由到index模块的News控制器的read操作
//Route::rule('new/:id','index/News/read');
//http://www.thinkphp.net/api 代替http://www.thinkphp.net/home/api.Export/index
Route::rule('api','home/api.Export/index');
Route::rule('web','home/web.ExportData/index');
//Route::get('api','home/api.Export/index');
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

];
