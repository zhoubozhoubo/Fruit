<?php

namespace app\api\logic;

use app\model\UserCoupon;

class UserCouponLog
{

    /**
     * 获取用户优惠券列表
     * @param $userId
     * @param $isUse
     * @param $status
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUserCouponList($userId,$isUse=0,$status=1)
    {
        $where = [
            'user_id' => $userId,
            'is_use' => $isUse,
            'status' => $status,
            'is_delete' => 0
        ];
        $db = UserCoupon::where($where)->field('id,coupon_id,start,end,is_use,status')->order('gmt_create DESC')->select();
        if ($db) {
            foreach ($db as $item) {
                $item->coupon;
            }
            return $db;
        } else {
            return [];
        }
    }

    /**
     * 使用用户优惠券
     * @param $userCouponId
     * @return UserCoupon|array
     */
    public function useUserCoupon($userCouponId){
        $data = [
            'id'=>$userCouponId,
            'is_use'=>1
        ];
        $db = UserCoupon::update($data);
        if ($db) {
            return $db;
        } else {
            return [];
        }
    }
}
