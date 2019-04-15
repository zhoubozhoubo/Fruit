<?php

namespace app\model;

/**
 * 商品model
 */
class Goods extends Base
{

    public function getMoneyAttr($value)
    {
        return number_format($value / 100, 2, '.', '');
    }

    public function getOriginalMoneyAttr($value)
    {
        return number_format($value / 100, 2, '.', '');
    }

    public function setMoneyAttr($value)
    {
        return $value * 100;
    }

    public function setOriginalMoneyAttr($value)
    {
        return $value * 100;
    }

    /**
     * 关联商品类型名称
     */
    public function goodsType()
    {
        return $this->hasOne('GoodsType', 'id', 'type_id')->field('name');
    }
}
