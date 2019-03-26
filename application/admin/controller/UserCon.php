<?php

namespace app\admin\controller;

use app\model\User;
use app\model\UserAddress;
use app\model\UserCoupon;
use app\util\ReturnCode;

/**
 * 用户控制器
 */
class UserCon extends Base
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
        foreach (['name,nickname,phone'] as $key) {
            if (isset($getData[$key]) && $getData[$key] !== '') {
                $where[$key] = ['like', "%{$getData[$key]}%"];
            }
        }
        $db = User::where($where)->field('id,name,nickname,avatarurl,phone,province,city,area,comment,status');
        return parent::_list($db);
    }

    public function _index_data_filter(&$data)
    {
        foreach ($data as &$item) {
            $item['area'] = [$item['province'], $item['city'], $item['area']];
            $item['area_com'] = '';
            if (!empty($item['area'][0])) {
                $item['area_com'] .= $item['area'][0] . '/';
                if (!empty($item['area'][1])) {
                    $item['area_com'] .= $item['area'][1] . '/';
                    if (!empty($item['area'][2])) {
                        $item['area_com'] .= $item['area'][2] . '/';
                    }
                }
            }
            $item['area']=array_filter($item['area']);
            $item['area_com'] .= $item['comment'];
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
            $res = User::create($postData);
        }else{
            $res = User::update($postData);
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
        $res = User::update([
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
        $res = User::del($id);
        if ($res === false) {
            return $this->buildFailed(ReturnCode::DELETE_FAILED, '删除失败');
        } else {
            return $this->buildSuccess([]);
        }
    }

    /**
     * 获取用户收货地址
     */
    public function getAddress()
    {
        $getData = $this->request->get();
        $where = [
            'user_id' => $getData['user_id']
        ];
        $db = UserAddress::where($where)->field('id,name,phone,province,city,area,comment,is_default');
        return parent::_list($db);
    }

    /**
     * 获取用户优惠券
     */
    public function getCoupon()
    {
        $getData = $this->request->get();
        $where = [
            'user_id' => $getData['user_id']
        ];
        $db = UserCoupon::where($where)->field('id,coupon_id,start,end,is_use');
        return parent::_list($db, ['coupon']);
    }

    public function _getCoupon_data_filter(&$data)
    {
        foreach ($data as &$item) {
            $item['coupon_name'] = $item['coupon']['name'];
            $item['coupon_term'] = $item['coupon']['term'];
        }
    }

}
