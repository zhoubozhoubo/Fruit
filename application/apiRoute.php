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
Route::rule('api/5c8f365c71082','api/api/GoodsTypeCon/getGoodsTypeList', 'GET', ['after_behavior' => $afterBehavior]);Route::rule('api/5cb44c4f0ba5b','api/api/GoodsTypeCon/getGoodsTypeListGoods', 'GET', ['after_behavior' => $afterBehavior]);Route::rule('api/5cb6946b3a801','api/api/GoodsCon/getGoodsList', 'GET', ['after_behavior' => $afterBehavior]);Route::rule('api/5cb6f3a202861','api/api/GoodsCon/getGoodsDetails', 'GET', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbadf2a25e49','api/api/UserBagCon/getUserBagGoodsList', 'GET', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbae65dad566','api/api/UserBagCon/addGoods', 'POST', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbaea94d7a17','api/api/UserBagCon/delGoods', 'GET', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbaf182ce091','api/api/UserBagCon/changeGoodsNum', 'POST', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbaf4c31cfee','api/api/UserAddressCon/getUserAddressList', 'GET', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbaf6796681e','api/api/UserAddressCon/getUserAddressDetails', 'GET', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbb16bc97690','api/api/UserAddressCon/aoeUserAddress', 'POST', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbb182aea6a9','api/api/UserAddressCon/delUserAddress', 'GET', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbb1dc2b441c','api/api/UserCouponCon/getUserCouponList', 'GET', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbb1fe74aef7','api/api/UserCouponCon/useUserCoupon', 'GET', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbb23614e378','api/api/OrdersCon/getOrdersList', 'GET', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbc3b77297e5','api/api/Login/index', 'POST', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbc43e233672','api/api/Login/check', 'POST', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbc51cec85bd','api/api/Login/perfect', 'POST', ['after_behavior' => $afterBehavior]);Route::rule('api/5cbc5d613bee8','api/api/Index/getBannerList', 'GET', ['after_behavior' => $afterBehavior]);