<?php

/**
 * Created by PhpStorm.
 * User: yhlyl
 * Date: 2017/7/14
 * Time: 23:53
 * 接口
 */
namespace app\home\controller\api;
class Export
{
    public function index()
    {
        $model = new \app\home\model\ExportModel();
        return json_encode($model->sales());
    }
}