<?php

namespace app\model;

/**
 * 用户优惠券model
 */
class UserCoupon extends Base
{

    /**
     * 关联优惠券
     */
    public function coupon()
    {
        return $this->hasOne('Coupon', 'id', 'coupon_id')->field('name,term');
    }

    /**
     * 关联购物袋商品
     */
    public function goods()
    {
        return $this->hasOne('Goods', 'id', 'goods_id')->field('id,name,img,money');
    }
}
