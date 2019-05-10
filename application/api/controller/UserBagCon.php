<?php

namespace app\api\controller;

use app\api\logic\UserBagLog;
use app\util\ReturnCode;

/**
 * 用户购物袋控制器
 */
class UserBagCon extends Base
{

    public $userBag;

    public function _initialize()
    {
        parent::_initialize();
        $this->userBag = new UserBagLog();
    }

    /**
     * 获取用户购物袋商品列表
     */
    public function getUserBagGoodsList()
    {
        $this->requestType();
        $userId = 41;
        if(!$userId){
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS,'参数缺失');
        }
        $res = $this->userBag->getUserBagGoodsList($userId);
        return $this->buildSuccess($res);
    }

    /**
     * 添加商品到购物袋
     */
    public function addGoods()
    {
        $this->requestType('POST');
        $data=[
            'user_id'=>41,
            'goods_id'=>$this->request->post('id'),
            'goods_num'=>$this->request->post('number')
        ];
        $res = $this->userBag->addGoods($data);
        if ($res) {
            return $this->buildSuccess($res);
        } else {
            return $this->buildFailed(ReturnCode::ADD_FAILED, '添加失败', []);
        }
    }

    /**
     * 改变购物袋商品数量
     */
    public function changeGoodsNum()
    {
        $this->requestType('POST');
        $data=[
            'id'=>$this->request->post('id'),
            'goods_num'=>$this->request->post('number')
        ];
        $res = $this->userBag->changeGoodsNum($data);
        if ($res) {
            return $this->buildSuccess($res);
        } else {
            return $this->buildFailed(ReturnCode::UPDATE_FAILED, '更新失败', []);
        }
    }

    /**
     * 从购物袋删除商品
     */
    public function delGoods()
    {
        $this->requestType();
        $userBagId = $this->request->get('userBagId');
        if(!$userBagId){
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS,'参数缺失');
        }
        $res = $this->userBag->delGoods($userBagId);
        if ($res) {
            return $this->buildSuccess($res);
        } else {
            return $this->buildFailed(ReturnCode::DELETE_FAILED, '删除失败', []);
        }
    }
}
