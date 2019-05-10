<?php

namespace app\api\logic;

use app\model\UserBag;

class UserBagLog
{

    /**
     * 获取用户购物袋商品列表
     * @param $userId
     * @return array|false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getUserBagGoodsList($userId)
    {
        $where = [
            'user_id' => $userId
        ];
        $db = UserBag::where($where)->field('id,goods_id,goods_num')->select();
        if ($db) {
            foreach ($db as $item) {
                $item->goods;
            }
            return $db;
        } else {
            return [];
        }
    }

    /**
     * 添加商品到购物袋
     * @param $data
     * @return UserBag|array
     */
    public function addGoods($data)
    {
        $db = UserBag::create($data);
        if ($db) {
            return $db;
        } else {
            return [];
        }
    }

    /**
     * 改变购物袋商品数量
     * @param $data
     * @return UserBag|array
     */
    public function changeGoodsNum($data)
    {
        $db = UserBag::update($data);
        if ($db) {
            return $db;
        } else {
            return [];
        }
    }

    /**
     * 从购物袋删除商品
     * @param $userBagId
     * @return array|int
     */
    public function delGoods($userBagId)
    {
        $db = UserBag::destroy($userBagId);
        if ($db) {
            return $db;
        } else {
            return [];
        }
    }
}
