<?php

namespace app\api\controller;

/**
 * 商品类型控制器
 */
class GoodsTypeCon extends Base
{

    public $goodsType;

    public function _initialize()
    {
        parent::_initialize();
        $this->goodsType = new \app\api\logic\GoodsTypeLog();
    }

    /**
     * 获取商品分类列表以及推荐分类下商品列表
     */
    public function getGoodsTypeListGoods()
    {
        $this->requestType();
        $res = $this->goodsType->getGoodsTypeListGoods();
        return $this->buildSuccess($res);
    }
}
