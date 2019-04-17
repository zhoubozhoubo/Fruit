<?php

namespace app\api\logic;

use app\model\GoodsType;

/**
 * 商品类型逻辑层
 */
class GoodsTypeLog
{

    /**
     * 获取商品分类列表以及推荐分类下商品列表
     */
    public function getGoodsTypeListGoods()
    {
        $where = [
            'status' => 1,
            'is_delete' => 0
        ];
        $db = GoodsType::where($where)->field('id,name,img,recommend')->order('recommend DESC, sort ASC')->select();
        if($db){
            foreach ($db as $item) {
                // 当商品分类为推荐时查询分类下商品列表
                if ($item['recommend'] === 1) {
                    $item->goodsList;
                }
            }
            return $db;
        }else{
            return [];
        }
    }
}
