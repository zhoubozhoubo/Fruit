<?php

namespace app\api\logic;

use app\model\Banner;

class IndexLog
{

    /**
     * 获取banner列表
     * @return array|false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getBannerList(){
        $where = [
            'status' => 1
        ];
        $db = Banner::where($where)->field('id,name,img')->order('gmt_create DESC')->select();
        if($db){
            return $db;
        }else{
            return [];
        }
    }
}
