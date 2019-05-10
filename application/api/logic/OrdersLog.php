<?php

namespace app\api\logic;

use app\model\Orders;

class OrdersLog
{

    /**
     * 获取用户订单列表
     * @param $userId
     * @param $status
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getOrdersList($userId,$status=0)
    {
        $where = [
            'user_id' => $userId,
            'is_delete' => 0
        ];
        if($status!==0){
            $where['status']=$status;
        }
        $db = Orders::where($where)->field('id,number,wx_number,logistics_company_id,logistics_number,goods_money,freight_money,total_money,address_id,pay_time,refund_number,refund_reason,status,gmt_create')->order('gmt_create DESC')->select();
        if ($db) {
            foreach ($db as $item) {
                $item->logisticsCompany;
                $item->userAddress;
                $item->ordersGoods;
            }
            return $db;
        } else {
            return [];
        }
    }
}
