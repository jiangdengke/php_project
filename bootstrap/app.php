<?php

/**
 * 应用引导文件：创建并配置 Laravel Application 实例、路由、中间件与异常处理。
 */

/**
 * 该文件负责启动框架
 */
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// 创建并配置整个 Laravel 应用实例。
return Application::configure(basePath: dirname(__DIR__))
    // 指定 Web、API、Artisan 路由以及健康检查的路径。
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/auth.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 在这里注册全局中间件、路由中间件等。
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // 在这里自定义异常处理逻辑。
    })->create();
