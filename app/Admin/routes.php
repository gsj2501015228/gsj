<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    //商品页面
    $router->get('/goods','GoodController@index')->name('goods');
    //添加商品
    $router->get('/goods/create','GoodAddController@index')->name('goods/create');
    //购物车页面
    $router->get('/shopping','ShoppingController@index')->name('shopping');
    //订单页面
    $router->get('/order','OrderController@index')->name('order');
    //添加购物车
    $router->post('/good/shopping/{id}','ShoppingController@aff');
    //购物车商品数量增加
    $router->post('/shopping/add/{id}','ShoppingController@add');
    //购物车商品减少
    $router->post('/shopping/reduce/{id}','ShoppingController@reduce');
    //购物车新增
    $router->get('/shopping/create','GoodController@index')->name('shopping/create');
    //订单新增
    $router->get('/order/create','ShoppingController@index')->name('order/create');
    //内容页
    $router->get('/goods/{id}','ContentController@index');

});