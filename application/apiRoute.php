<?php
/**
 * Api路由
 */

use think\Route;

Route::group('api', function () {
    Route::miss('api/Miss/index');
});
$afterBehavior = [
    '\app\api\behavior\ApiAuth',
    '\app\api\behavior\ApiPermission',
    '\app\api\behavior\RequestFilter'
];
Route::rule('api/5c8f365c71082','api/1', 'GET', ['after_behavior' => $afterBehavior]);Route::rule('api/5cb44c4f0ba5b','api/GoodsTypeCon/getGoodsTypeListGoods', 'GET', ['after_behavior' => $afterBehavior]);