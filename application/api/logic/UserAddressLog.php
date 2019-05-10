<?php

namespace app\api\logic;

use app\model\UserAddress;

class UserAddressLog
{

    /**
     * 获取用户地址列表
     * @param $userId
     * @return array|false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUserAddressList($userId)
    {
        $where = [
            'user_id' => $userId,
            'status' => 1,
            'is_delete' => 0
        ];
        $db = UserAddress::where($where)->field('id,name,phone,province,city,area,comment,is_default')->order('gmt_create DESC')->select();
        if ($db) {
            return $db;
        } else {
            return [];
        }
    }

    /**
     * 获取用户地址详情
     * @param $userAddressId
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUserAddressDetails($userAddressId)
    {
        $where = [
            'id' => $userAddressId,
            'status' => 1,
            'is_delete' => 0
        ];
        $db = UserAddress::where($where)->field('id,name,phone,province,city,area,comment,is_default')->find();
        if ($db) {
            return $db;
        } else {
            return [];
        }
    }

    /**
     * 添加/编辑用户地址
     * @param $data
     * @return UserAddress|array
     */
    public function aoeUserAddress($data)
    {
        if(!isset($data['id']) || $data['id'] === 0){
            $db = UserAddress::create($data);
        }else{
            $db = UserAddress::update($data);
        }
        if ($db) {
            return $db;
        } else {
            return [];
        }
    }

    /**
     * 删除用户地址
     * @param $userAddressId
     * @return array|int
     */
    public function delUserAddress($userAddressId)
    {
        $db = UserAddress::del($userAddressId);
        if ($db) {
            return $db;
        } else {
            return [];
        }
    }
}
