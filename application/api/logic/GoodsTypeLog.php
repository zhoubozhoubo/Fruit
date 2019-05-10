<?php

namespace app\api\logic;

use app\model\GoodsType;

/**
 * 商品类型逻辑层
 */
class GoodsTypeLog
{

    /**
     * 获取未推荐商品分类列表
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getGoodsTypeList()
    {
        $where = [
            'recommend' => 0,
            'status' => 1,
            'is_delete' => 0
        ];
        $db = GoodsType::where($where)->field('id,name,img,recommend')->order('recommend DESC, sort ASC')->select();
        if ($db) {
            return $db;
        } else {
            return [];
        }
    }

    /**
     * 获取推荐商品分类以及分类下商品列表
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getGoodsTypeListGoods()
    {
        $where = [
            'recommend' => 1,
            'status' => 1,
            'is_delete' => 0
        ];
        $db = GoodsType::where($where)->field('id,name,img,recommend')->order('recommend DESC, sort ASC')->select();
        if ($db) {
            foreach ($db as $item) {
                $item->goodsList;
            }
            return $db;
        } else {
            return [];
        }
    }
}
