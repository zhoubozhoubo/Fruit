<?php

namespace app\admin\controller;

use app\model\Orders;
use app\model\OrdersGoods;
use app\util\ReturnCode;

/**
 * 订单控制器
 */
class OrdersCon extends Base
{

    /**
     * 获取列表
     */
    public function index()
    {
        $getData = $this->request->get();
        $where = [
            'Orders.is_delete' => 0
        ];
        $userWhere=[];
        if (isset($getData['status']) && $getData['status'] !== '') {
            $where['Orders.status'] = $getData['status'];
        }
        foreach (['number', 'courier_company', 'courier_number'] as $key) {
            if(isset($getData[$key]) && $getData[$key] !== ''){
                $where['Orders.'.$key]=['like',"%{$getData[$key]}%"];
            }
        }
        foreach (['name', 'phone'] as $key) {
            if(isset($getData[$key]) && $getData[$key] !== ''){
                $userWhere[$key]=['like',"%{$getData[$key]}%"];
            }
        }
//        $db = Orders::hasWhere('userAddress', $userWhere)->where($where)->field('id,user_id,number,courier_company,courier_number,goods_money,freight_money,total_money,address_id,pay_time,status,gmt_create,gmt_modified');
        $db = Orders::hasWhere('userAddress', $userWhere)->where($where);
        return parent::_list($db, ['user', 'logisticsCompany', 'userAddress']);
    }

    public function _index_data_filter(&$data)
    {
        foreach ($data as &$item) {
            $item['user_name'] = $item['user']['name'];
            $item['logistics_company_name'] = $item['logisticsCompany']['name'];
            $item['orders_name'] = $item['userAddress']['name'];
            $item['orders_phone'] = $item['userAddress']['phone'];
            $item['orders_address'] = $item['userAddress']['province'] . '/' . $item['userAddress']['city'] . '/' . $item['userAddress']['area'] . '/' . $item['userAddress']['comment'];
        }
    }

    /**
     * 获取订单商品列表
     */
    public function getGoods()
    {
        $getData = $this->request->get();
        $where = [
            'orders_id' => $getData['orders_id']
        ];
        $db = OrdersGoods::where($where)->field('id,goods_id,goods_num,total_money');
        return parent::_list($db, ['goods']);
    }

    public function _getGoods_data_filter(&$data)
    {
        foreach ($data as &$item) {
            $item['goods_name'] = $item['goods']['name'];
            $item['goods_img'] = $item['goods']['img'];
            $item['goods_money'] = $item['goods']['money'];
        }
    }

    /**
     * 发货
     */
    public function send()
    {
        $postData = $this->request->post();
        $res = Orders::update($postData);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::UPDATE_FAILED, '更新记录失败');
        } else {
            return $this->buildSuccess([]);
        }
    }

    /**
     * 退款
     */
    public function refund()
    {
        $getData = $this->request->get();
        // TODO 退款逻辑
        $data = [
            'id'=>$getData['id'],
            'status'=>$getData['status']
        ];
        $res = Orders::update($data);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::UPDATE_FAILED, '更新记录失败');
        } else {
            return $this->buildSuccess([]);
        }
    }

}
