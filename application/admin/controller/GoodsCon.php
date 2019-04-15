<?php

namespace app\admin\controller;

use app\model\Goods;
use app\util\ReturnCode;

/**
 * 商品控制器
 */
class GoodsCon extends Base
{

    /**
     * 获取列表
     */
    public function index()
    {
        $getData = $this->request->get();
        $where = [
            'is_delete' => 0
        ];
        if (isset($getData['status']) && $getData['status'] !== '') {
            $where['status'] = $getData['status'];
        }
        if (isset($getData['type_id']) && $getData['type_id'] !== '') {
            $where['type_id'] = $getData['type_id'];
        }
        foreach (['name'] as $key) {
            if (isset($getData[$key]) && $getData[$key] !== '') {
//                $db->whereLike($key, "%{$getData[$key]}%");
                $where[$key] = ['like', "%{$getData[$key]}%"];
            }
        }
        $db = Goods::where($where)->field('id,name,img,describe,type_id,money,original_money,comment,number,status');
        return parent::_list($db, ['goodsType']);
    }

    public function _index_data_filter(&$data)
    {
        foreach ($data as &$item) {
            $item['type_name'] = $item['goodsType']['name'];
        }
    }

    /**
     * 新增/编辑数据
     */
    public function aoe()
    {
        $postData = $this->request->post();
        if(!isset($postData['id']) || $postData['id'] === 0){
            $res = Goods::create($postData);
        }else{
            $res = Goods::update($postData);
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
    public function changeStatus()
    {
        $getData = $this->request->get();
        $res = Goods::update([
            'id' => $getData['id'],
            'status' => $getData['status']
        ]);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::UPDATE_FAILED, '更新失败');
        } else {
            return $this->buildSuccess([]);
        }
    }

    /**
     * 删除数据
     */
    public function del()
    {
        $id = $this->request->get('id');
        if (!$id) {
            return $this->buildFailed(ReturnCode::EMPTY_PARAMS, '缺少必要参数');
        }
        $res = Goods::del($id);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DELETE_FAILED, '删除失败');
        } else {
            return $this->buildSuccess([]);
        }
    }

}
