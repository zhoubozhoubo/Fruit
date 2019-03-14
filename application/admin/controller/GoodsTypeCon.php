<?php

namespace app\admin\controller;

use app\model\Goods;
use app\model\GoodsType;
use app\util\ReturnCode;
use app\util\Tools;

/**
 * 商品类型控制器
 */
class GoodsTypeCon extends Base {

    /**
     * 获取列表
     */
    public function index() {
        $where = [
            'is_delete'=>0
        ];
        $list = GoodsType::where($where)->field('id,fid,name,describe,sort,status')->order('sort', 'ASC')->select();
        $list = Tools::buildArrFromObj($list);
        $list = formatTree(listToTree($list));
        return $this->buildSuccess([
            'list' => $list
        ]);
    }

    /**
     * 新增/编辑数据
     */
    public function aoe() {
        $postData = $this->request->post();
        if(!isset($postData['id']) || $postData['id'] === 0){
            $res = GoodsType::create($postData);
        }else{
            $res = GoodsType::update($postData);
        }
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DB_SAVE_ERROR, '操作失败');
        } else {
            return $this->buildSuccess([]);
        }
    }

    /**
     * 改变数据状态
     */
    public function changeStatus() {
        $getData = $this->request->get();
        $res = GoodsType::update([
            'id'   => $getData['id'],
            'status' => $getData['status']
        ]);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::UPDATE_FAILED, '更新失败');
        } else {
            // 若该类型为一级类型,禁用的话则将下面子类型同时禁用
            if($getData['status'] === '0'){
                if(GoodsType::where(['id'=>$getData['id']])->value('fid') === 0){
                    GoodsType::where(['fid'=>$getData['id']])->update(['status'=>0]);
                }
            }
            return $this->buildSuccess([]);
        }
    }

    /**
     * 删除数据
     */
    public function del() {
        $id = $this->request->get('id');
        if (!$id) {
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS, '缺少必要参数');
        }
        $childNum = GoodsType::where(['fid' => $id])->count();
        if ($childNum) {
            return $this->buildFailed(ReturnCode::INVALID, '当前类型存在子类型,不可以被删除!');
        } else {
            //删除类型时，判断商品类型下是否有商品
            $goods = Goods::where(['type_id' => $id, 'is_delete' => 0])->count();
            if ($goods) {
                return $this->buildFailed(ReturnCode::DELETE_FAILED, '删除失败，该类型下存在商品');
            }
            GoodsType::del($id);
            return $this->buildSuccess([]);
        }
    }

}
