<?php

namespace app\api\controller;

use app\api\logic\OrdersLog;
use app\util\ReturnCode;

/**
 * 订单控制器
 */
class OrdersCon extends Base
{

    public $orders;

    public function _initialize()
    {
        parent::_initialize();
        $this->orders = new OrdersLog();
    }

    /**
     * 获取用户订单列表
     */
    public function getOrdersList(){
        $this->requestType();
        $userId = 41;
        $status = $this->request->get('status',0);
        if(!$userId){
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS,'参数缺失');
        }
        $res = $this->orders->getOrdersList($userId,$status);
        return $this->buildSuccess($res);
    }
}
