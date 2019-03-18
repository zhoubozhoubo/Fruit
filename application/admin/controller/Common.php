<?php

namespace app\admin\controller;

use app\model\GoodsType;
use app\model\LogisticsCompany;
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
        $res=GoodsType::where($where)->field('id,name')->order('sort ASC')->select();
        return $this->buildSuccess($res);
    }

    /**
     * 物流公司列表
     */
    public function logisticsCompanyList() {
        $where = [
            'status'=>1,
            'is_delete'=>0
        ];
        $res=LogisticsCompany::where($where)->field('id,name')->order('sort ASC')->select();
        return $this->buildSuccess($res);
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
