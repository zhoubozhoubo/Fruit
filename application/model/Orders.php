<?php

namespace app\model;

/**
 * 订单model
 */
class Orders extends Base
{

    public function getGoodsMoneyAttr($value)
    {
        return number_format($value / 100, 2, '.', '');
    }

    public function getFreightMoneyAttr($value)
    {
        return number_format($value / 100, 2, '.', '');
    }

    public function getTotalMoneyAttr($value)
    {
        return number_format($value / 100, 2, '.', '');
    }

    /**
     * 关联用户信息
     */
    public function user()
    {
        return $this->hasOne('User', 'id', 'user_id')->field('name');
    }

    /**
     * 关联物流公司信息
     */
    public function logisticsCompany()
    {
        return $this->hasOne('LogisticsCompany', 'id', 'logistics_company_id')->field('name');
    }

    /**
     * 关联订单地址信息
     */
    public function userAddress()
    {
        return $this->hasOne('UserAddress', 'id', 'address_id')->field('name,phone,province,city,area,comment');
    }

    /**
     * 关联订单商品信息
     */
    public function ordersGoods()
    {
        return $this->hasMany('OrdersGoods', 'orders_id', 'id')->field('goods_id,goods_num,total_money')
            ->with('goods');
    }
}
