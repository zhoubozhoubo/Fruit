<?php

use think\Route;

$afterBehavior = [
    '\app\admin\behavior\ApiAuth',
    '\app\admin\behavior\ApiPermission',
    '\app\admin\behavior\AdminLog'
];

Route::group('admin', function () use ($afterBehavior) {
    //一些带有特殊参数的路由写到这里
    Route::rule([
        'Login/index'  => [
            'admin/Login/index',
            ['method' => 'post']
        ],
        'Index/upload' => [
            'admin/Index/upload',
            [
                'method'         => 'post',
                'after_behavior' => [
                    '\app\admin\behavior\ApiAuth',
                    '\app\admin\behavior\AdminLog'
                ]
            ]
        ],
        'Login/logout' => [
            'admin/Login/logout',
            [
                'method'         => 'get',
                'after_behavior' => [
                    '\app\admin\behavior\ApiAuth',
                    '\app\admin\behavior\AdminLog'
                ]
            ]
        ]
    ]);
    //大部分控制器的路由都以分组的形式写到这里
    Route::group('Menu', [
        'index'        => [
            'admin/Menu/index',
            ['method' => 'get']
        ],
        'changeStatus' => [
            'admin/Menu/changeStatus',
            ['method' => 'get']
        ],
        'add'          => [
            'admin/Menu/add',
            ['method' => 'post']
        ],
        'edit'         => [
            'admin/Menu/edit',
            ['method' => 'post']
        ],
        'del'          => [
            'admin/Menu/del',
            ['method' => 'get']
        ]
    ], ['after_behavior' => $afterBehavior]);
    Route::group('User', [
        'index'        => [
            'admin/User/index',
            ['method' => 'get']
        ],
        'getUsers'     => [
            'admin/User/getUsers',
            ['method' => 'get']
        ],
        'changeStatus' => [
            'admin/User/changeStatus',
            ['method' => 'get']
        ],
        'add'          => [
            'admin/User/add',
            ['method' => 'post']
        ],
        'own'          => [
            'admin/User/own',
            ['method' => 'post']
        ],
        'edit'         => [
            'admin/User/edit',
            ['method' => 'post']
        ],
        'del'          => [
            'admin/User/del',
            ['method' => 'get']
        ],
    ], ['after_behavior' => $afterBehavior]);
    Route::group('Auth', [
        'index'        => [
            'admin/Auth/index',
            ['method' => 'get']
        ],
        'changeStatus' => [
            'admin/Auth/changeStatus',
            ['method' => 'get']
        ],
        'add'          => [
            'admin/Auth/add',
            ['method' => 'post']
        ],
        'delMember'    => [
            'admin/Auth/delMember',
            ['method' => 'get']
        ],
        'edit'         => [
            'admin/Auth/edit',
            ['method' => 'post']
        ],
        'del'          => [
            'admin/Auth/del',
            ['method' => 'get']
        ],
        'getGroups'    => [
            'admin/Auth/getGroups',
            ['method' => 'get']
        ],
        'getRuleList'  => [
            'admin/Auth/getRuleList',
            ['method' => 'get']
        ]
    ], ['after_behavior' => $afterBehavior]);
    Route::group('App', [
        'index'            => [
            'admin/App/index',
            ['method' => 'get']
        ],
        'refreshAppSecret' => [
            'admin/App/refreshAppSecret',
            ['method' => 'get']
        ],
        'changeStatus'     => [
            'admin/App/changeStatus',
            ['method' => 'get']
        ],
        'add'              => [
            'admin/App/add',
            ['method' => 'post']
        ],
        'getAppInfo'       => [
            'admin/App/getAppInfo',
            ['method' => 'get']
        ],
        'edit'             => [
            'admin/App/edit',
            ['method' => 'post']
        ],
        'del'              => [
            'admin/App/del',
            ['method' => 'get']
        ]
    ], ['after_behavior' => $afterBehavior]);
    Route::group('InterfaceList', [
        'index'        => [
            'admin/InterfaceList/index',
            ['method' => 'get']
        ],
        'changeStatus' => [
            'admin/InterfaceList/changeStatus',
            ['method' => 'get']
        ],
        'add'          => [
            'admin/InterfaceList/add',
            ['method' => 'post']
        ],
        'refresh'      => [
            'admin/InterfaceList/refresh',
            ['method' => 'get']
        ],
        'edit'         => [
            'admin/InterfaceList/edit',
            ['method' => 'post']
        ],
        'del'          => [
            'admin/InterfaceList/del',
            ['method' => 'get']
        ],
        'getHash'      => [
            'admin/InterfaceList/getHash',
            ['method' => 'get']
        ]
    ], ['after_behavior' => $afterBehavior]);
    Route::group('Fields', [
        'index'    => [
            'admin/Fields/index',
            ['method' => 'get']
        ],
        'request'  => [
            'admin/Fields/request',
            ['method' => 'get']
        ],
        'add'      => [
            'admin/Fields/add',
            ['method' => 'post']
        ],
        'response' => [
            'admin/Fields/response',
            ['method' => 'get']
        ],
        'edit'     => [
            'admin/Fields/edit',
            ['method' => 'post']
        ],
        'del'      => [
            'admin/Fields/del',
            ['method' => 'get']
        ],
        'upload'   => [
            'admin/Fields/upload',
            ['method' => 'post']
        ]
    ], ['after_behavior' => $afterBehavior]);
    Route::group('InterfaceGroup', [
        'index'        => [
            'admin/InterfaceGroup/index',
            ['method' => 'get']
        ],
        'getAll'       => [
            'admin/InterfaceGroup/getAll',
            ['method' => 'get']
        ],
        'add'          => [
            'admin/InterfaceGroup/add',
            ['method' => 'post']
        ],
        'changeStatus' => [
            'admin/InterfaceGroup/changeStatus',
            ['method' => 'get']
        ],
        'edit'         => [
            'admin/InterfaceGroup/edit',
            ['method' => 'post']
        ],
        'del'          => [
            'admin/InterfaceGroup/del',
            ['method' => 'get']
        ]
    ], ['after_behavior' => $afterBehavior]);
    Route::group('AppGroup', [
        'index'        => [
            'admin/AppGroup/index',
            ['method' => 'get']
        ],
        'getAll'       => [
            'admin/AppGroup/getAll',
            ['method' => 'get']
        ],
        'add'          => [
            'admin/AppGroup/add',
            ['method' => 'post']
        ],
        'changeStatus' => [
            'admin/AppGroup/changeStatus',
            ['method' => 'get']
        ],
        'edit'         => [
            'admin/AppGroup/edit',
            ['method' => 'post']
        ],
        'del'          => [
            'admin/AppGroup/del',
            ['method' => 'get']
        ]
    ], ['after_behavior' => $afterBehavior]);
    Route::group('Log', [
        'index' => [
            'admin/Log/index',
            ['method' => 'get']
        ],
        'del'   => [
            'admin/Log/del',
            ['method' => 'get']
        ]
    ], ['after_behavior' => $afterBehavior]);
    //公共控制器
    Route::group('Common', [
        //商品一级类型列表
        'firstGoodsTypeList' => [
            'admin/Common/firstGoodsTypeList',
            ['method' => 'get']
        ],
        //商品二级类型列表
        'secondGoodsTypeList' => [
            'admin/Common/secondGoodsTypeList',
            ['method' => 'get']
        ],
        //地区列表
        'area' => [
            'admin/Common/area',
            ['method' => 'get']
        ]
    ], ['after_behavior' => $afterBehavior]);
    //用户
    Route::group('UserCon', [
        'index' => [
            'admin/UserCon/index',
            ['method' => 'get']
        ],
        'aoe'   => [
            'admin/UserCon/aoe',
            ['method' => 'post']
        ],
        'changeStatus'   => [
            'admin/UserCon/changeStatus',
            ['method' => 'get']
        ],
        'del'   => [
            'admin/UserCon/del',
            ['method' => 'get']
        ]
    ], ['after_behavior' => $afterBehavior]);
    //用户地址
    Route::group('UserAddressCon', [
        'index' => [
            'admin/UserAddressCon/index',
            ['method' => 'get']
        ],
        'aoe'   => [
            'admin/UserAddressCon/aoe',
            ['method' => 'post']
        ],
        'changeDefault'   => [
            'admin/UserAddressCon/changeDefault',
            ['method' => 'get']
        ],
        'changeStatus'   => [
            'admin/UserAddressCon/changeStatus',
            ['method' => 'get']
        ],
        'del'   => [
            'admin/UserAddressCon/del',
            ['method' => 'get']
        ]
    ], ['after_behavior' => $afterBehavior]);
    //商品类型
    Route::group('GoodsTypeCon', [
        'index' => [
            'admin/GoodsTypeCon/index',
            ['method' => 'get']
        ],
        'aoe'   => [
            'admin/GoodsTypeCon/aoe',
            ['method' => 'post']
        ],
        'changeStatus'   => [
            'admin/GoodsTypeCon/changeStatus',
            ['method' => 'get']
        ],
        'del'   => [
            'admin/GoodsTypeCon/del',
            ['method' => 'get']
        ]
    ], ['after_behavior' => $afterBehavior]);
    //商品
    Route::group('GoodsCon', [
        'index' => [
            'admin/GoodsCon/index',
            ['method' => 'get']
        ],
        'aoe'   => [
            'admin/GoodsCon/aoe',
            ['method' => 'post']
        ],
        'changeRecommend'   => [
            'admin/GoodsCon/changeRecommend',
            ['method' => 'get']
        ],
        'changeStatus'   => [
            'admin/GoodsCon/changeStatus',
            ['method' => 'get']
        ],
        'del'   => [
            'admin/GoodsCon/del',
            ['method' => 'get']
        ]
    ], ['after_behavior' => $afterBehavior]);
    //订单
    Route::group('OrdersCon', [
        'index' => [
            'admin/OrdersCon/index',
            ['method' => 'get']
        ],
        'getGoods' => [
            'admin/OrdersCon/getGoods',
            ['method' => 'get']
        ],
        'send'   => [
            'admin/OrdersCon/send',
            ['method' => 'post']
        ],
        'refund'   => [
            'admin/OrdersCon/refund',
            ['method' => 'get']
        ]
    ], ['after_behavior' => $afterBehavior]);
    Route::miss('admin/Miss/index');
});
