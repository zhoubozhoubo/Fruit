<?php

namespace app\model;

/**
 * 商品类型model
 */
class GoodsType extends Base
{

    /**
     * 关联商品列表
     */
    public function goodsList()
    {
        return $this->hasMany('Goods', 'type_id', 'id')->field('id,name,img');
//            ->with('goods');
    }
}
