<?php

namespace app\api\controller;

use app\util\ReturnCode;

class GoodsTypeCon extends Base
{

    public $goodsType;

    public function _initialize()
    {
        parent::_initialize();
        $this->goodsType = new \app\api\logic\GoodsTypeLog();
    }

    public function getGoodsTypeListGoods()
    {
        if(!$this->request->isGet()){
            return $this->buildFailed(ReturnCode::METHOD_ERROR, '请求方式错误');
        }
        $res = $this->goodsType->getGoodsTypeListGoods();
        return $this->buildSuccess($res);
    }
}
