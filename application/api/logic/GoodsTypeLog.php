<?php

namespace app\api\logic;

use app\model\GoodsType;

class GoodsTypeLog
{
    public function getGoodsTypeListGoods()
    {
        $where=[
            'status'=>1,
            'is_delete'=>0
        ];
        $db = GoodsType::where($where)->field('id,name,img')->order('sort ASC')->select();
        foreach ($db as $item){
            $item->goodsList;
        }
        return $db;
    }
}
