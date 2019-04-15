<?php

namespace app\api\controller;

class GoodsTypeCon extends Base
{
    public function index()
    {
        if(){

        }
        return $this->buildSuccess([
            'Product' => config('apiAdmin.APP_NAME'),
            'Version' => config('apiAdmin.APP_VERSION'),
            'Company' => config('apiAdmin.COMPANY_NAME'),
            'ToYou' => "I'm glad to meet you（终于等到你123！）"
        ]);
    }
}
