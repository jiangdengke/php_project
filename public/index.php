<?php

/**
 * HTTP 请求入口：加载自动加载器、引导 Laravel 应用并返回响应。
 */

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// 记录应用启动的时间，用于性能分析。
define('LARAVEL_START', microtime(true));

// 如果站点处于维护模式，则直接加载维护页面脚本并终止后续流程。
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// 引入 Composer 自动加载文件，使得类可自动按命名空间加载。
require __DIR__.'/../vendor/autoload.php';

// 引导（bootstrap）Laravel 应用，并处理当前 HTTP 请求。
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

// 捕获当前请求并交给应用实例处理，最终输出响应。
$app->handleRequest(Request::capture());
