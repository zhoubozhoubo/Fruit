<?php

namespace app\api\controller;

use app\util\ReturnCode;

/**
 * 商品控制器
 */
class GoodsCon extends Base
{

    public $goods;

    public function _initialize()
    {
        parent::_initialize();
        $this->goods = new \app\api\logic\GoodsLog();
    }

    /**
     * 通过商品分类id查询分类下商品列表
     */
    public function getGoodsList()
    {
        $this->requestType();
        $goodsTypeId = $this->request->get('goodsTypeId', 0);
        if(!$goodsTypeId){
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS,'参数缺失');
        }
        $res = $this->goods->getGoodsList($goodsTypeId);
        return $this->buildSuccess($res);
    }

    /**
     * 通过商品id查询商品详情
     */
    public function getGoodsDetails(){
        $this->requestType();
        $goodsId = $this->request->get('goodsId', 0);
        if(!$goodsId){
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS,'参数缺失');
        }
        $res = $this->goods->getGoodsDetails($goodsId);
        return $this->buildSuccess($res);
    }
}
