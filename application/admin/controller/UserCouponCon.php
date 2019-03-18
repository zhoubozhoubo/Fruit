<?php

namespace app\admin\controller;

use app\model\UserCoupon;
use app\util\ReturnCode;

/**
 * 用户优惠券控制器
 */
class UserCouponCon extends Base
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
        if (isset($getData['is_use']) && $getData['is_use'] !== '') {
            $where['is_use'] = $getData['is_use'];
        }
        $db = UserCoupon::where($where)->field('id,coupon_id,start,end,is_use');
        return parent::_list($db, ['coupon']);
    }

    public function _index_data_filter(&$data)
    {
        foreach ($data as &$item) {
            $item['coupon_name'] = $item['coupon']['name'];
            $item['coupon_term'] = $item['coupon']['term'];
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
        $res = UserCoupon::del($id);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DELETE_FAILED, '删除失败');
        } else {
            return $this->buildSuccess([]);
        }
    }

}
