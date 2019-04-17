<?php

namespace app\api\logic;

use app\model\Goods;

class GoodsLog
{

    /**
     * 通过商品分类id查询分类下商品列表
     * @param $goodsTypeId
     * @return array|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getGoodsList($goodsTypeId)
    {
        $where = [
            'type_id'=>$goodsTypeId,
            'status' => 1,
            'is_delete' => 0
        ];
        $db = Goods::where($where)->field('id,name,img,describe,money,original_money,number')->order('gmt_create DESC')->select();
        if($db){
            return $db;
        }else{
            return [];
        }
    }

    /**
     * 通过商品id查询商品详情
     * @param $goodsId
     * @return array|\PDOStatement|string|\think\Model|null
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getGoodsDetails($goodsId){
        $where = [
            'id'=>$goodsId,
            'status' => 1,
            'is_delete' => 0
        ];
        $db = Goods::where($where)->field('id,name,img,describe,money,original_money,comment,number')->find();
        if($db){
            return $db;
        }else{
            return [];
        }
    }
}
