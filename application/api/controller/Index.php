<?php

namespace app\api\controller;

use app\api\logic\IndexLog;

/**
 * 首页控制器
 */
class Index extends Base
{

    public $index;

    public function _initialize()
    {
        parent::_initialize();
        $this->index = new IndexLog();
    }

    /**
     * 获取banner列表
     */
    public function getBannerList()
    {
        $this->requestType();
        $res = $this->index->getBannerList();
        return $this->buildSuccess($res);
    }
}
