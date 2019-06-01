<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

Route::auth();

// 控制台
Route::get('/', 'Admin\HomeController@index');

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'Admin'], function () {
    // 公众号管理
    Route::group(['prefix' => 'wechat'], function () {
        Route::resource('info', 'WechatInfoController', ['except' => ['create', 'edit']]);
        Route::resource('menu', 'WechatMenuController');
        Route::resource('follower', 'WechatFollowerController', ['except' => ['create', 'edit', 'show', 'destroy','store']]);
        Route::post('pushMenu', 'WechatMenuController@pushMenu');
        Route::put('refresh', 'WechatFollowerController@refresh');
    });
    // 店铺管理
    Route::group(['prefix' => 'shop'], function () {
        Route::resource('config', 'ShopConfigController', ['except' => ['create', 'edit', 'show', 'destroy']]);
        Route::resource('banner', 'ShopBannerController');
    });
    // 商品管理
    Route::group(['prefix' => 'product'], function () {
        Route::resource('topic', 'TopicController');
        Route::resource('plate', 'PlateController');
        Route::resource('category', 'CategoryController');
        Route::resource('goods', 'GoodsController');
        // get goods by category
        Route::get('cate/{id}', 'GoodsController@cateGoods');
        // 富文本编辑器上传图片
        Route::post('editorUpload', 'GoodsController@editorUpload');
    });
    // 订单管理
    Route::resource('order', 'OrderController', ['except' => ['create']]);
});

// DEBUG
Route::get('/wechat/debug', 'WechatController@debug');

// Wechat http main route
Route::any('/wechat', 'WechatController@serve');

// 微信商城
Route::group(['prefix' => 'mall', 'middleware' => ['web', 'wechat.oauth:snsapi_userinfo'], 'namespace' => 'Mall'], function () {
    // Wechat OAuth2.0 (type=snsapi_userinfo)
    Route::get('/user', 'IndexController@oauth');
    // 首页
    Route::get('/', 'IndexController@index');
});

Route::group(['prefix' => 'api', 'middleware' => 'web', 'namespace' => 'Api'], function () {
    // goods
    Route::get('goods', 'ShopController@getGoods');
    // goods item
    Route::get('goods/{id}', 'ShopController@getGoodsDetail');
    // search goods
    Route::get('search/{keyword}', 'ShopController@searchGoods');
    // user info
    Route::get('userinfo', 'UserController@userinfo');
    // shop config
    Route::get('config', 'ShopController@shopconfig');
    // banners
    Route::get('banners', 'ShopController@getBanners');
    // topics
    Route::get('topics', 'ShopController@getTopics');
    // topic items
    Route::get('topic/{id}', 'ShopController@getTopicItems');
    // blocks
    Route::get('blocks', 'ShopController@getBlocks');
    // block items
    Route::get('block/{id}', 'ShopController@getBlockItems');
    // categories
    Route::get('categories', 'ShopController@getCategories');
    // category items
    Route::get('category/{id}', 'ShopController@getCategoryItems');
    // cart items
    Route::resource('cart', 'CartController', ['except' => ['create', 'edit', 'show']]);
    // delete item in cart
    Route::delete('cart/delete/{id}', 'CartController@delete');
    // order list（all,unpay,unreceived）
    Route::get('orderlist/{type}', 'OrderController@index');
    // 创建订单
    Route::post('order', 'OrderController@store');
    // 获取订单数据
    Route::get('order/{id}', 'OrderController@show');
    // 获取订单详情
    Route::get('order/detail/{id}', 'OrderController@detail');
    // delete order
    Route::delete('order/delete/{id}', 'OrderController@delete');
    // pay order
    Route::post('pay', 'OrderController@payOrder');

    // 根据不同条件获取商品数据集合
    Route::post('commodities/plate', 'ShopController@getCommodityByPlate');
    Route::post('commodities/category', 'ShopController@getCommodityByCategory');
    Route::get('commodities/{commodity}', 'ShopController@getCommodities');
    // 获取购物车数据总条数
    Route::get('cart/count', 'CartController@calculateTotal');
    Route::post('cart/empty', 'CartController@emptyCart');
    // 地址管理
    Route::get('address', 'UserController@indexAddress');
    Route::post('address', 'UserController@storeAddress');
    Route::get('address/{id}', 'UserController@showAddress');
    Route::put('address/{id}', 'UserController@updateAddress');
    Route::get('default/address', 'UserController@defaultAddress');
    Route::delete('address/{id}', 'UserController@deleteAddress');
    // 意见建议
    Route::post('suggestion', 'UserController@suggestion');
});
