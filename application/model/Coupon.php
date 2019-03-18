<?php

namespace app\model;

/**
 * 优惠券model
 */
class Coupon extends Base
{

    public function getFullMoneyAttr($value)
    {
        return number_format($value / 100, 2, '.', '');
    }

    public function getReduceMoneyAttr($value)
    {
        return number_format($value / 100, 2, '.', '');
    }

    public function setFullMoneyAttr($value)
    {
        return $value * 100;
    }

    public function setReduceMoneyAttr($value)
    {
        return $value * 100;
    }
}
