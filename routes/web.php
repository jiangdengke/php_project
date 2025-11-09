<?php

use Illuminate\Support\Facades\Route;

// 定义处理浏览器访问的 Web 路由集合。
Route::get('/', function () {
    // 当访问网站根路径时，渲染 resources/views/welcome.blade.php 视图页面。
    return view('welcome');
});


/**
 * 想要一个 json 数据响应的话，就直接 return 数组即可
 */

Route::get('/first-route', function () {
    // 返回一个字符串
    return ['first' => '第一个路由'];
});
