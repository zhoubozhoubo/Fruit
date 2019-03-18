<?php

namespace app\admin\controller;

use app\model\LogisticsCompany;
use app\util\ReturnCode;

/**
 * 物流公司控制器
 */
class LogisticsCompanyCon extends Base
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
        foreach (['name'] as $key) {
            if (isset($getData[$key]) && $getData[$key] !== '') {
                $where[$key] = ['like', "%{$getData[$key]}%"];
            }
        }
        $db = LogisticsCompany::where($where)->field('id,name,sort,status')->order('sort', 'ASC');
        return parent::_list($db);
    }

    /**
     * 新增/编辑数据
     */
    public function aoe()
    {
        $postData = $this->request->post();
        if (!isset($postData['id']) || $postData['id'] === 0) {
            $res = LogisticsCompany::create($postData);
        } else {
            $res = LogisticsCompany::update($postData);
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
        $res = LogisticsCompany::update([
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
        $res = LogisticsCompany::del($id);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DELETE_FAILED, '删除失败');
        } else {
            return $this->buildSuccess([]);
        }
    }

}
