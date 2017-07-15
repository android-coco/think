<?php

/**
 * Created by PhpStorm.
 * User: yhlyl
 * Date: 2017/7/14
 * Time: 23:54
 * 页面控制器
 */
namespace app\home\controller\web;
use think\Config;

class ExportData
{
    public function index($page = 1)
    {
        $currdData = date("Y-m-d");
        $start = empty(\think\Request::instance()->has('start_time','get',true)) ? $currdData : input('?get.start_time');
        $end =  empty(\think\Request::instance()->has('end_time','get',true)) ? $currdData : input('?get.end_time');
        $model = new \app\home\model\ExportModel();
        $name = $model->sales($start,$end,$page);
        $data['info'] = $name['info'];
        $data['num'] = $name['num'];
        $data['base_url'] = Config::get('app_host');
        $data['per_page'] = $page;
        $data['start'] = $currdData;
        $data['end'] = $currdData;
        $data['total_page'] = ceil(($data['num'] / 10));
//        dump($data);
//        die();
        return view('export_message',$data);
    }


    public function ajaxData()
    {
        //http://www.thinkphp.net/home/web.ExportData/ajaxdata?page=79&start_time=2017-07-15&end_time=2017-07-15
        $currdData = date("Y-m-d");
        $start = empty(\think\Request::instance()->has('start_time','get',true)) ? $currdData : input('get.start_time');
        $end = empty(\think\Request::instance()->has('end_time','get',true)) ? $currdData : input('get.end_time');
        $page = empty(\think\Request::instance()->has('page','get',true)) ? 1 : input('get.page');
        $model = new \app\home\model\ExportModel();
        $data = $model->sales($start,$end,$page);

//        $data['info'] = $name['info'];
//        $data['num'] = $name['num'];
        $data['base_url'] = Config::get('app_host');
        $data['per_page'] = $page;
        $data['start'] = $start;
        $data['end'] = $end;
        $data['total_page'] = ceil(($data['num'] / 10));
//        var_dump($data['info']);die();
        return $data;
    }

    //导出数据
    public function exportToData()
    {
        $currdData = date("Y-m-d");
        $start = empty(\think\Request::instance()->has('start_time','get',true)) ? $currdData : input('get.start_time');
        $end = empty(\think\Request::instance()->has('end_time','get',true)) ? $currdData : input('get.end_time');
        $model = new \app\home\model\ExportModel();
        $data = $model->sales($start,$end,'all');
        $header = array('订单详情id','订单id','菜品id','总数量','已取餐数量','已退押金',
            '用户申请退款数量','原始价格','减免价格','需支付价格','最后修改时间','购买者用户昵称','菜品名称','下单时间','支付类型1=微信，2=支付宝','店铺名称');
        excel_download($header,$data['info']);
    }

}