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
use PHPExcel_IOFactory;
use PHPExcel;

class ExportData
{
    public function index($page = 1)
    {
        $currdData = date("Y-m-d");
        $start = empty(\think\Request::instance()
            ->has('start_time', 'get', true)) ? $currdData : input('?get.start_time');
        $end = empty(\think\Request::instance()
            ->has('end_time', 'get', true)) ? $currdData : input('?get.end_time');
        $model = new \app\home\model\ExportModel();
        $name = $model->sales($start, $end, $page);
        $data['info'] = $name['info'];
        $data['num'] = $name['num'];
        $data['base_url'] = Config::get('app_host');
        $data['per_page'] = $page;
        $data['start'] = $currdData;
        $data['end'] = $currdData;
        $data['total_page'] = ceil(($data['num'] / 10));
//        dump($data);
//        die();
        return view('export_message', $data);
    }


    public function ajaxData()
    {
        //http://www.thinkphp.net/home/web.ExportData/ajaxdata?page=79&start_time=2017-07-15&end_time=2017-07-15
        $currdData = date("Y-m-d");
        $start = empty(\think\Request::instance()
            ->has('start_time', 'get', true)) ? $currdData : input('get.start_time');
        $end = empty(\think\Request::instance()
            ->has('end_time', 'get', true)) ? $currdData : input('get.end_time');
        $page = empty(\think\Request::instance()
            ->has('page', 'get', true)) ? 1 : input('get.page');
        $model = new \app\home\model\ExportModel();
        $data = $model->sales($start, $end, $page);

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
        $start = empty(\think\Request::instance()
            ->has('start_time', 'get', true)) ? $currdData : input('get.start_time');
        $end = empty(\think\Request::instance()
            ->has('end_time', 'get', true)) ? $currdData : input('get.end_time');
        $model = new \app\home\model\ExportModel();
        $data = $model->sales($start, $end, '','all');
//        dump($data);die();
        $header = array('订单详情id', '订单id', '菜品id', '总数量', '已取餐数量', '已退押金',
            '用户申请退款数量', '原始价格', '减免价格', '需支付价格', '最后修改时间', '购买者用户昵称', '菜品名称', '下单时间', '支付类型1=微信，2=支付宝', '店铺名称');
        $this->excel_download($header, $data['info']);
    }

    public function excel_download($header, $params)
    {
        $string = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);
        date_default_timezone_set('Asia/Shanghai');
        $objPHPExcel = new PHPExcel();
        if (PHP_SAPI == 'cli')
        {
            die('This example should only be run from a Web Browser');
        }

        // 设置文件内容
        $objPHPExcel->getProperties()
            ->setCreator("Maarten Balliauw")
            ->setLastModifiedBy("Maarten Balliauw")
            ->setTitle("Office 2007 XLSX Test Document")
            ->setSubject("Office 2007 XLSX Test Document")
            ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("Test result file");
        // 重定向客户端浏览器(Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . date('Ymdhsm') . '.xlsx"');
        header('Cache-Control: max-age=0');
        // 如果你的是IE9则需要下面内容
        header('Cache-Control: max-age=1');

        // 如果你的IE版本超过了 SSL, 则需要下面内容
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // 过去时间
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // 缓存格式
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        // 设置文件头
        if (!empty($header))
        {
            foreach ($header as $key => $value)
            {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue($string[$key] . '1', $value);
            }
        }
        //导出内容
        if (!empty($params))
        {
            foreach ($params as $key => $value)
            {
                $num = $key + 2;
                $i = 0;
                if (empty($value))
                {
                    continue;
                }
                foreach ($value as $k => $v)
                {
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($string[$i] . $num, $v);
                    $i++;
                }
            }
        }

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
}