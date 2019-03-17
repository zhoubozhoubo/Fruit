<?php

namespace app\admin\controller;

use app\model\GoodsType;
use think\Db;

/**
 * 公共控制器
 */
class Common extends Base {

    /**
     * 商品类型列表
     */
    public function goodsTypeList() {
        $where = [
            'status'=>1,
            'is_delete'=>0
        ];
        $db=GoodsType::where($where)->field('id,name');
        return parent::_list($db);
    }

    /**
     * 地区列表
     */
    public function area() {
        //省级
        $data = Db::name('area')->where('level',1)->field('id,name as label,name as value')->select();
        foreach ($data as $k=>&$v){
            //市级
            $v['children']=Db::name('area')->where(['level'=>2,'pid'=>$v['id']])->field('id,name as label,name as value')->select();
            foreach ($v['children'] as $key=>&$val){
                //县级
                $val['children']=Db::name('area')->where(['level'=>3,'pid'=>$val['id']])->field('id,name as label,name as value')->select();
            }
        }
        return $this->buildSuccess($data);
    }

}
