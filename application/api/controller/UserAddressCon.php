<?php

namespace app\api\controller;

use app\api\logic\UserAddressLog;
use app\util\ReturnCode;

/**
 * 用户地址控制器
 */
class UserAddressCon extends Base
{

    public $userAddress;

    public function _initialize()
    {
        parent::_initialize();
        $this->userAddress = new UserAddressLog();
    }

    /**
     * 获取用户地址列表
     */
    public function getUserAddressList()
    {
        $this->requestType();
        $userId = 41;
        if(!$userId){
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS,'参数缺失');
        }
        $res = $this->userAddress->getUserAddressList($userId);
        return $this->buildSuccess($res);
    }

    /**
     * 获取用户地址详情
     */
    public function getUserAddressDetails()
    {
        $this->requestType();
        $userAddressId = $this->request->get('userAddressId');
        if(!$userAddressId){
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS,'参数缺失');
        }
        $res = $this->userAddress->getUserAddressDetails($userAddressId);
        return $this->buildSuccess($res);
    }

    /**
     * 添加/编辑用户地址
     */
    public function aoeUserAddress()
    {
        $this->requestType('POST');
        $data=[
            'id'=>$this->request->post('id'),
            'user_id'=>41,
            'name'=>$this->request->post('name'),
            'phone'=>$this->request->post('phone'),
        ];
        if(!$data['user_id']){
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS,'参数缺失');
        }
        $res = $this->userAddress->aoeUserAddress($data);
        return $this->buildSuccess($res);
    }

    /**
     * 删除用户地址
     */
    public function delUserAddress()
    {
        $this->requestType();
        $userAddressId = $this->request->get('userAddressId');
        if(!$userAddressId){
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS,'参数缺失');
        }
        $res = $this->userAddress->delUserAddress($userAddressId);
        return $this->buildSuccess($res);
    }

}
