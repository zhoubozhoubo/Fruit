<?php

namespace app\admin\controller;

use app\model\UserAddress;
use app\util\ReturnCode;

/**
 * 用户地址控制器
 */
class UserAddressCon extends Base
{

    /**
     * 获取列表
     */
    public function index()
    {
        $getData = $this->request->get();
        $where = [
            'user_id'=>$getData['id'],
            'is_delete' => 0
        ];
        if (isset($getData['status']) && $getData['status'] !== '') {
            $where['status'] = $getData['status'];
        }
        foreach (['name,phone'] as $key) {
            if (isset($getData[$key]) && $getData[$key] !== '') {
                $where[$key] = ['like', "%{$getData[$key]}%"];
            }
        }
        $db = UserAddress::where($where)->field('id,name,phone,province,city,area,comment,is_default,status');
        return parent::_list($db);
    }

    public function _index_data_filter(&$data)
    {
        foreach ($data as &$item) {
            $item['area_com'] = [$item['province'], $item['city'], $item['area']];
            $item['area_com']=array_filter($item['area_com']);
        }
    }

    /**
     * 新增/编辑数据
     */
    public function aoe()
    {
        $postData = $this->request->post();
        $address=$postData['area'];
        unset($postData['area']);
        $postData['province'] = $address[0] ?? '';
        $postData['city'] = $address[1] ?? '';
        $postData['area'] = $address[2] ?? '';
        if(!isset($postData['id']) || $postData['id'] === 0){
            $res = UserAddress::create($postData);
        }else{
            $res = UserAddress::update($postData);
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
    public function changeDefault()
    {
        $getData = $this->request->get();
        $res = UserAddress::update([
            'id' => $getData['id'],
            'is_default' => $getData['is_default']
        ]);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::UPDATE_FAILED, '更新失败');
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
        $res = UserAddress::update([
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
        $res = UserAddress::del($id);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DELETE_FAILED, '删除失败');
        } else {
            return $this->buildSuccess([]);
        }
    }

}
