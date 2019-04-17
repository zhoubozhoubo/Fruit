<?php

namespace app\admin\controller;

use app\model\UserBag;
use app\util\ReturnCode;

/**
 * 用户购物袋控制器
 */
class UserBagCon extends Base
{

    /**
     * 获取列表
     */
    public function index()
    {
        $getData = $this->request->get();
        $where = [
            'user_id'=>$getData['id']
        ];
        $db = UserBag::where($where)->field('id,goods_id,goods_num');
        return parent::_list($db, ['goods']);
    }

    public function _index_data_filter(&$data)
    {
        foreach ($data as &$item) {
            $item['goods_name'] = $item['goods']['name'];
//            $item['coupon_term'] = $item['coupon']['term'];
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
