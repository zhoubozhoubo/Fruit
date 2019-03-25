<?php

namespace app\admin\controller;

use app\model\Coupon;
use app\model\CouponType;
use app\util\ReturnCode;

/**
 * 优惠券类型控制器
 */
class CouponTypeCon extends Base
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
        $db = CouponType::where($where)->field('id,name,describe,status');
        return parent::_list($db);
    }

    /**
     * 新增/编辑数据
     */
    public function aoe()
    {
        $postData = $this->request->post();
        if (!isset($postData['id']) || $postData['id'] === 0) {
            $res = CouponType::create($postData);
        } else {
            $res = CouponType::update($postData);
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
        $res = CouponType::update([
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
        //删除优惠券类型时，判断优惠券类型下是否有优惠券
        $coupon = Coupon::where(['type_id' => $id, 'is_delete' => 0])->count();
        if ($coupon) {
            return $this->buildFailed(ReturnCode::DELETE_FAILED, '删除失败，该类型下存在商品');
        }
        $res = CouponType::del($id);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DELETE_FAILED, '删除失败');
        } else {
            return $this->buildSuccess([]);
        }
    }

}
