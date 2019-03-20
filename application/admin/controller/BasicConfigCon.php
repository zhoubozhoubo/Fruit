<?php

namespace app\admin\controller;

use app\model\BasicConfig;
use app\util\ReturnCode;

/**
 * 基本配置控制器
 */
class BasicConfigCon extends Base
{

    /**
     * 获取列表
     */
    public function index()
    {
        $res = [];
        $db = BasicConfig::field('name,value')->select();
        if ($db) {
            foreach ($db as &$item) {
                $res[$item['name']] = $item['value'];
            }
        }
        return $this->buildSuccess($res);
    }

    /**
     * 编辑数据
     */
    public function edit()
    {
        $postData = $this->request->post();
        foreach ($postData as $key=>$val) {
            BasicConfig::update(['value'=>$val],['name'=>$key]);
        }
        return $this->buildSuccess([]);
    }

}
