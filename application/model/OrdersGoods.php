<?php

namespace app\model;

/**
 * 订单商品model
 */
class OrdersGoods extends Base
{

    public function getTotalMoneyAttr($value)
    {
        return number_format($value / 100, 2, '.', '');
    }

    /**
     * 关联商品信息
     */
    public function goods()
    {
        return $this->hasOne('Goods', 'id', 'goods_id')->field('id,name,img,money');
    }
}
