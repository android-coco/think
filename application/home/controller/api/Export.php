<?php

/**
 * Created by PhpStorm.
 * User: yhlyl
 * Date: 2017/7/14
 * Time: 23:53
 * 接口
 */
namespace app\home\controller\api;
use app\home\model\ExportModel;

class Export
{
    public function index()
    {
        $model = new ExportModel();
        return json($model->sales($start = "2017-08-09", $end = "2017-08-09", $page = 0));
    }
}