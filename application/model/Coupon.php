<?php

namespace app\model;

/**
 * 优惠券model
 */
class Coupon extends Base
{

    public function getConditionMoneyAttr($value)
    {
        return number_format($value / 100, 2, '.', '');
    }

    public function getFullMoneyAttr($value)
    {
        return number_format($value / 100, 2, '.', '');
    }

    public function getReduceMoneyAttr($value)
    {
        return number_format($value / 100, 2, '.', '');
    }

    public function setConditionMoneyAttr($value)
    {
        return $value * 100;
    }

    public function setFullMoneyAttr($value)
    {
        return $value * 100;
    }

    public function setReduceMoneyAttr($value)
    {
        return $value * 100;
    }

    /**
     * 关联优惠券类型名称
     */
    public function couponType()
    {
        return $this->hasOne('CouponType', 'id', 'type_id')->field('name');
    }
}
