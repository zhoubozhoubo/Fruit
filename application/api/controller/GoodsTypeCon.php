<?php

namespace app\api\controller;

use app\api\logic\GoodsTypeLog;

/**
 * 商品类型控制器
 */
class GoodsTypeCon extends Base
{

    public $goodsType;

    public function _initialize()
    {
        parent::_initialize();
        $this->goodsType = new GoodsTypeLog();
    }

    /**
     * 获取未推荐商品分类列表
     */
    public function getGoodsTypeList()
    {
        $this->requestType();
        $res = $this->goodsType->getGoodsTypeList();
        return $this->buildSuccess($res);
    }

    /**
     * 获取推荐商品分类以及分类下商品列表
     */
    public function getGoodsTypeListGoods()
    {
        $this->requestType();
        $res = $this->goodsType->getGoodsTypeListGoods();
        return $this->buildSuccess($res);
    }
}
