<?php
/**
 * Created by PhpStorm.
 * User: yhlyl
 * Date: 2017/7/15
 * Time: 00:18
 */

namespace app\home\model;

use think\model;
use think\Db;

class ExportModel extends model
{
    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }

    public function getZone()
    {
        return Db::query('select * from `zone`');
    }

    public function sales($start = "2017-06-14", $end = "2017-06-14", $page = 0,$type = 0)
    {
        if ($page < 1)
        {
            $page = 1;
        }
        $onePage = 10;//每页显示多少
        $start1 = ($page - 1) * $onePage;//开始数据ID
        $sql = "select b.orderdetailid AS \"订单详情id\",
        b.orderid AS \"订单id\",
        b.menuid AS \"菜品id\",
        b.price AS \"价格\",
        b.amount AS \"总数量\",
        b.takeamount AS \"已取餐数量\",
        b.refundamount AS \"用户申请退款数量\",
        b.originalprice AS \"原始价格\",
        b.minusprice AS \"减免价格\",
        b.payprice AS \"需支付价格\",
        b.updatetime AS \"最后修改时间\",
        a.username AS \"购买者用户昵称\",
        c.menuname AS \"菜品名称\",
        a.dateline AS \"下单时间\",
        a.paytype AS \"支付类型\",
        d.sname AS \"店铺名称\" from `order` AS a,order_detail AS b, menu AS c, store AS d";
        $sqlWhere = " where a.orderid = b.orderid and a.paystatus = 1
        and (a.dateline >= '" . $start . " 00:00:00" . "' and a.dateline <= '" . $end . " 23:59:59" . "')
        and b.menuid = c.menuid and a.storeid = d.storeid ";
        if ($type)
        {
            $sqllimt = "";
        }
        else
        {
            $sqllimt = " limit " . $start1 . "," . $onePage;
        }
        $datainfo = Db::query($sql . $sqlWhere . $sqllimt);
        $dataAll = sizeof(Db::query($sql . $sqlWhere));
//        echo $page."  ".$start." ".$end;die();
//        echo $sql.$sqlWhere.$sqllimt;die();
//        dump(Db::query($sql.$sqlWhere.$sqllimt));
        return array("info" => $datainfo, "num" => $dataAll);
    }
}