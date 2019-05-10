<?php

namespace app\api\controller;

use app\api\logic\UserCouponLog;
use app\util\ReturnCode;

/**
 * 用户优惠券控制器
 */
class UserCouponCon extends Base
{

    public $userCoupon;

    public function _initialize()
    {
        parent::_initialize();
        $this->userCoupon = new UserCouponLog();
    }

    /**
     * 获取用户优惠券列表
     */
    public function getUserCouponList(){
        $this->requestType();
        $userId = 41;
        $isUse = $this->request->get('isUse',0);
        $status = $this->request->get('status',1);
        if(!$userId){
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS,'参数缺失');
        }
        $res = $this->userCoupon->getUserCouponList($userId,$isUse,$status);
        return $this->buildSuccess($res);
    }

    /**
     * 使用用户优惠券
     */
    public function useUserCoupon(){
        $this->requestType();
        $userCouponId = $this->request->get('userCouponId');
        if(!$userCouponId){
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS,'参数缺失');
        }
        $res = $this->userCoupon->useUserCoupon($userCouponId);
        return $this->buildSuccess($res);
    }
}
