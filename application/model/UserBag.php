<?php

namespace app\model;

/**
 * 用户购物袋model
 */
class UserBag extends Base
{

    /**
     * 关联商品信息
     */
    public function goods()
    {
        return $this->hasOne('Goods', 'id', 'goods_id')->field('id,name,img,money');
    }
}
